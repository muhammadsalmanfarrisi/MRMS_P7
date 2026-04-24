import os
import time
import logging
from datetime import datetime, timedelta
from dotenv import load_dotenv
import psycopg2
import requests

# ========== LOAD ENVIRONMENT ==========
# Ganti path sesuai lokasi file .env Laravel Anda
load_dotenv("/Users/muhammadsalmanfarrisi/Herd/MRMS_SP7/.env")

# ========== KONFIGURASI ==========
BOT_TOKEN = os.getenv("NOTIFICATION_BOT_TOKEN")
GROUP_CHAT_ID = os.getenv("MANUFACTURE_GROUP_CHAT_ID")

DB_HOST = os.getenv("DB_HOST")
DB_PORT = os.getenv("DB_PORT")
DB_DATABASE = os.getenv("DB_DATABASE")
DB_USER = os.getenv("DB_USER")
DB_PASSWORD = os.getenv("DB_PASSWORD")

# ========== LOGGING ==========
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s - %(levelname)s - %(message)s",
    handlers=[
        logging.FileHandler("group_notifier.log"),
        logging.StreamHandler(),  # juga tampilkan di terminal
    ],
)
logger = logging.getLogger(__name__)


def get_db_connection():
    """Buat koneksi ke database PostgreSQL."""
    try:
        conn = psycopg2.connect(
            host=DB_HOST,
            port=DB_PORT,
            database=DB_DATABASE,
            user=DB_USER,
            password=DB_PASSWORD,
        )
        return conn
    except Exception as e:
        logger.error(f"❌ Gagal koneksi database: {e}")
        return None


def send_telegram_message(text):
    """Kirim pesan teks ke grup Telegram."""
    if not BOT_TOKEN or not GROUP_CHAT_ID:
        logger.error("❌ BOT_TOKEN atau GROUP_CHAT_ID belum diatur di .env")
        return False

    url = f"https://api.telegram.org/bot{BOT_TOKEN}/sendMessage"
    payload = {
        "chat_id": GROUP_CHAT_ID,
        "text": text,
        "parse_mode": "Markdown",
        "disable_web_page_preview": True,
    }
    try:
        response = requests.post(url, json=payload, timeout=10)
        if response.status_code == 200:
            logger.info("✅ Notifikasi terkirim ke grup")
            return True
        else:
            logger.error(f"❌ Gagal kirim: {response.text}")
            return False
    except Exception as e:
        logger.error(f"❌ Error kirim pesan: {e}")
        return False


def fetch_recent_activities(since: datetime):
    """
    Ambil 10 task terbaru yang diupdate setelah `since` (waktu terakhir pengecekan).
    """
    conn = get_db_connection()
    if not conn:
        return []

    try:
        cur = conn.cursor()
        cur.execute(
            """
            SELECT id, reporter_name, damaged_tool, status, created_at, updated_at
            FROM tasks
            WHERE status IN ('unprocessed', 'processed', 'worked_on', 'finished')
              AND updated_at > %s
            ORDER BY updated_at DESC
            LIMIT 10
        """,
            (since,),
        )
        rows = cur.fetchall()
        cur.close()
        conn.close()

        activities = []
        for row in rows:
            task_id, reporter, tool, status, created_at, updated_at = row

            # Tentukan aksi: created atau updated
            if created_at and updated_at and created_at == updated_at:
                action = "created"
            else:
                action = "updated"

            # Abaikan task dengan status unprocessed yang hanya diupdate
            if action == "updated" and status == "unprocessed":
                continue

            activities.append(
                {
                    "id": task_id,
                    "reporter_name": reporter or "Unknown",
                    "damaged_tool": tool or "-",
                    "status": status,
                    "action": action,
                    "time": (
                        updated_at.strftime("%d/%m/%Y %H:%M")
                        if updated_at
                        else datetime.now().strftime("%d/%m/%Y %H:%M")
                    ),
                }
            )

        return activities
    except Exception as e:
        logger.error(f"❌ Error fetch data: {e}")
        return []


def build_message(activities):
    """Susun teks notifikasi dari data aktivitas."""
    if not activities:
        return None

    message = "🔔 *AKTIVITAS MAINTENANCE TERBARU* 🔔\n\n"

    status_emoji = {
        "unprocessed": "⏳",
        "processed": "⚡",
        "worked_on": "🛠️",
        "finished": "✅",
    }

    for act in activities:
        emoji = status_emoji.get(act["status"], "📌")
        action_text = "➕ Baru" if act["action"] == "created" else "🔄 Update"
        message += f"{emoji} *{act['damaged_tool']}*\n"
        message += f"   📋 {act['reporter_name']} · {action_text} · {act['time']}\n\n"

    message += "_Notifikasi otomatis dari sistem maintenance_"
    return message


def main():
    logger.info("🚀 Group Notifier dimulai...")

    # Pertama kali, cek task sejak 1 menit yang lalu
    last_check = datetime.now() - timedelta(minutes=1)

    # Kirim pesan pembuka bahwa bot aktif (opsional)
    send_telegram_message(
        "✅ *Bot notifikasi grup manufaktur aktif*\n_Semua perubahan status tugas akan dilaporkan di sini._"
    )

    while True:
        try:
            # Ambil aktivitas baru
            activities = fetch_recent_activities(last_check)

            # Perbarui waktu pengecekan SEKARANG (sebelum kirim, agar tidak kelewat)
            last_check = datetime.now()

            if activities:
                msg = build_message(activities)
                if msg:
                    send_telegram_message(msg)

            # Tunggu 10 detik sebelum cek lagi
            time.sleep(10)

        except KeyboardInterrupt:
            logger.info("⏹️ Bot dihentikan manual.")
            break
        except Exception as e:
            logger.error(f"❌ Error dalam loop: {e}")
            time.sleep(10)  # jangan spam jika error


if __name__ == "__main__":
    main()
