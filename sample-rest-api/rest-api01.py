#!flask/bin/python
from flask import Flask, jsonify

app = Flask(__name__)

products = [
    {
        'id': 101,
        'name': 'Kerudung Rabani'
    },
    {
        'id': 102,
        'name': 'Kopiah Wadimor'
    }
]

@app.route('/', methods=['GET'])
def get_product():
    return jsonify({'products': products})

if __name__ == '__main__':
    app.run(host='127.0.0.1')
