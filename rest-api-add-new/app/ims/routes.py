/app/ims/routes.py
import pymysql
from flask import render_template, redirect, url_for, flash
from wekzeug.urls import url_parse
from flask_babel import _
from app import db_inventory
from app.ims import bp
from app.ims.forms import AddNewProduct

@bp.route('/add_new', methods=['GET', 'POST'])
def add_new_product():
    form = AddNewProduct()
    if form.validate_on_submit():
        product_id = form.product_id.data
        product_category = form.product_category.data
        product_name = form.product_name.data
        connection = pymysql.connect(host = '192.168.43.205',
                                            user = 'username',
                                            password = 'password',
                                            db = 'inventory',
                                            charset = 'utf8mb4',
                                            cursorclass = pymysql.cursors.DictCursor)
        try:
            with connection.cursor() as cursor:
                query = 'INSERT INTO PRODUCTS (PRODUCT_ID, CATEGORY_ID, PRODUCT_NAME) VALUES ('%s', '%s', '%s')'
                cursor.execute(query, (product_id, product_category, product_name, ))
            connection.commit()

            with connection.cursor() as cursor:
                query = 'SELECT PRODUCT_ID, CATEGORY_ID, PRODUCT_NAME FROM PRODUCTS WHERE PRODUCT_NAME = %s'
                cursor.execute(query, (product_name, ))
            connection.commit()
        finally:
            connection.close()