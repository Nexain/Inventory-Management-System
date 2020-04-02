import time
import datetime
import MySQLdb
from MFRC522 import SimpleMFRC522
import RPi.GPIO as GPIO

db_inventory = MySQLdb.connect(host="192.168.43.205", user="username", passwd="password", db="inventory")

cursor_db = db_inventory.cursor()

reader = SimpleMFRC522()

try:
    product_id = input('New Product ID: ')
    category_id = input('New Product Category: ')
    product_name = input('New Product Name: ')
    sql = 'INSERT INTO PRODUCTS (PRODUCT_ID, CATEGORY_ID, PRODUCT_NAME) VALUES ('%s', '%s', '%s')'
    cursor.execute(sql, %(product_id, category_id, product_name))
    reader.write(text)
    print("Written")

finally:
    GPIO.cleanup