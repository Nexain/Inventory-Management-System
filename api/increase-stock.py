import pymysql.cursors
import time
import datetime
from time import sleep
import sys
from mfrc522 import SimpleMFRC522
reader = SimpleMFRC522()

# Connect to the database
connection = pymysql.connect(host='192.168.0.6',
                             user='somreve',
                             password='password',
                             db='inventory',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

try:
    while(1):
        print("Hold a tag near the reader")
        id, text = reader.read()
        print("ID: %s\nText: %s" % (id,text))
        ts = time.time()
        timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
        with connection.cursor() as cursor:
        # Create a new record
            sql = "INSERT INTO `WAREHOUSE_LOG` (`tag_id`, `product_id`, `wh_id`, `date_in`, `date_out`) VALUES (%s, %s, %s, %s, %s)"
            cursor.execute(sql, (id, text, 'BDG', timestamp, '0000-00-00 00:00:00'))
        connection.commit()
        print("Barang Masuk")


except KeyboardInterrupt:
    GPIO.cleanup()
    raise

finally:
    connection.close()
