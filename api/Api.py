from flask import Flask, jsonify, request, make_response
import pymysql.cursors
import time
import datetime

app = Flask(__name__)

connection = pymysql.connect(host = '192.168.0.11',
                                user = 'somreve',
                                password = 'password',
                                db = 'inventory',
                                charset = 'utf8mb4',
                                cursorclass = pymysql.cursors.DictCursor)

@app.errorhandler(400)
def bad_request(error):
    return make_response(jsonify( {'error': 'Bad request' } ), 400)

@app.errorhandler(404)
def not_found(error):
    return make_response(jsonify( {'error': 'Not found' } ), 404)

@app.route('/api')
def api_root():
    pass

@app.route('/api/products', methods=['GET'])
def api_products():
    with connection.cursor() as cursor:
        query = "SELECT PRODUCT_ID, CATEGORY_ID, PRODUCT_NAME, status FROM PRODUCTS"
        cursor.execute(query)
        data = cursor.fetchall()
        if data == '':
            abort(404)
    return jsonify(data)

@app.route('/api/products/add-new', methods=['POST'])
def api_add_new():
    if request.args is None:
        abort(400)
    product_id = '' + request.args['product_id']
    category_id = '' + request.args['category_id']
    product_name = '' + request.args['product_name']
    status = 'ST1'
    with connection.cursor() as cursor:
        query = "INSERT INTO PRODUCTS (PRODUCT_ID, CATEGORY_ID, PRODUCT_NAME, status) VALUES (%s, %s, %s, %s)"
        cursor.execute(query, (product_id, category_id, product_name, status))
    connection.commit()
    return make_response(jsonify({'status': 'SUCCESS'}), 200)

@app.route('/api/wh-log/increase-stock', methods=['POST'])
def api_increase_stock():
    if request.args is None:
        abort(400)
    tag_id = '' + request.args['tag_id']
    product_id = '' + request.args['product_id']
    wh_id = '' + request.args['wh_id']
    ts = time.time()
    date_in = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')   
    date_out = '0000-00-00 00:00:00'
    with connection.cursor() as cursor:
        query = "INSERT INTO WAREHOUSE_LOG (TAG_ID, PRODUCT_ID, WH_ID, DATE_IN, DATE_OUT) VALUES (%s, %s, %s, %s, %s)"
        cursor.execute(query, (tag_id, product_id, wh_id, date_in, '0000-00-00 00:00:00'))
        # cursor.execute(query, ('123332124', 'FP0001', 'BDG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'))
    connection.commit()
    return make_response(jsonify({'status': 'SUCCESS'}), 200)

@app.route('/api/wh-log/decrease-stock', methods=['PUT'])
def api_decrease_stock():
    if request.args is None:
        abort(400)
    tag_id = '' + request.args['tag_id']
    ts = time.time()
    date_out = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')   
    with connection.cursor() as cursor:
        query = "UPDATE warehouse_log SET date_out = %s WHERE `TAG_ID` = %s"
        value = (date_out, tag_id)
        cursor.execute(query, value)
    connection.commit()
    return make_response(jsonify({'status': 'SUCCESS'}), 200)

if __name__ == '__main__':
  app.debug = True
  app.run(host='0.0.0.0', port=5000)
