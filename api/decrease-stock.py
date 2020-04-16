import pymysql.cursors
import time
import datetime
from time import sleep
import sys
from mfrc522 import SimpleMFRC522
import RPi.GPIO as GPIO

reader = SimpleMFRC522()

# Connect to the database
connection = pymysql.connect(host='192.168.0.6',
                             user='somreve',
                             password='password',
                             db='inventory',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

lastId = None

try:
    while(1):
        print("Hold a tag near the reader")
        id, text = reader.read()

        if(id != None and text != None):
            if(id != lastId):
                print("ID: %s\nText: %s" % (id,text))
                ts = time.time()
                timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')   
                with connection.cursor() as cursor:
                        query = "UPDATE warehouse_log SET date_out = %s WHERE `TAG_ID` = %s"
                        value = (timestamp, id)
                        cursor.execute(query, value)
                connection.commit()
            lastId = id
        connection.close()
except KeyboardInterrupt:
    GPIO.cleanup()
    raise

# finally:
#     connection.close()