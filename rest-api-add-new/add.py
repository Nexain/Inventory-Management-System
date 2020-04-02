# import time
# import datetime
# import MySQLdb
# from MFRC522 import SimpleMFRC522
# import RPi.GPIO as GPIO
import pymysql.cursors
import time
import datetime
from time import sleep
import sys
# from mfrc522 import SimpleMFRC522
# reader = SimpleMFRC522()

connection = pymysql.connect(host='192.168.0.6',
                             user='somreve',
                             password='password',
                             db='inventory',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

try:
    product_id = input('New Product ID: ')
    category_id = input('New Product Category: ')
    product_name = input('New Product Name: ')
    with connection.cursor() as cursor:
    # Create a new record
        sql = "INSERT INTO `PRODUCTS` (`PRODUCT_ID`, `CATEGORY_ID`, `PRODUCT_NAME`) VALUES (%s, %s, %s)"
        cursor.execute(sql, (product_id, category_id, product_name))
        print("Written")
    connection.commit()
    connection.close()

except KeyboardInterrupt:
    GPIO.cleanup()
    raise

# finally:
    # GPIO.cleanup