from flask import Flask, jsonify, request, make_response
import pymysql

app = Flask(__name__)

connection = pymysql.connect(host = '192.168.43.205',
                                user = 'username',
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
    with connection.cursor() as cursor
        query = "SELECT PRODUCT_ID, CATEGORY_ID, PRODUCT_NAME, status FROM PRODUCTS"
        cursor.execute(query)
        data = cursor.fetchall()
        if data == ''
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
    with connection.cursor() as cursor
        query = "INSERT INTO PRODUCTS (PRODUCT_ID, CATEGORY_ID, PRODUCT_NAME, status) VALUES (%s, %s, %s, %s)"
        cursor.execute(query, (product_id, category_id, product_name, status))
    connection.commit()
    return make_response(jsonify({'status': 'SUCCESS'}), 200)