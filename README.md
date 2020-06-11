# polban-ims
Inventory - Automation Product Detection System

## Anggota kelompok
- Afif Rana Muhammad 	(171524001)
- Ahmad Aji Naufal Ali 	(171524002)
- Alifia Syalsabila (171524003)
- Imanda Syahrul Ramadhan (171524013)
- Muhammad Salman Al Hafizh (171524024)
- Mumuh Kustino Muharram (171524025)
- Sophia Gianina Daeli (171524029)

## 000Webhost Account
email : imandasr99@gmail.com
pwd   :anisette

## Database
we are using local database instead of domain hosting for development phase

## QUICK START
- Install MySQL, Python, Flask
- Run MySQL
- Run API on your PC
- Run RFID Driver on your Raspi
- If eror encountered, please make sure your host on Api.py, mockup, and driver is correct

## Dependencies
Flask
```
pip install flask
pip instal flask-sqlalchemy
```
PyMySQL
```
pip install PyMySQL
```
httplib2
```
pip install httplib2
```
RFID Module (Raspberry Pi)
```
pip install mfrc522
```

## RUN API
[Flask Quickstart](https://flask.palletsprojects.com/en/1.1.x/quickstart/).

### Windows CMD
```
set FLASK_APP=Api.py
flask run
```


## API
### PARAM
#### GET - api/products
none
#### POST - api/products/add-new
product_id, category_id, product_name
#### POST - api/wh-log/increase-stock
tag_id, product_id, wh_id
#### PUT - api/wh-log/decrease-stock
tag_id

## RFID DRIVER FOR RASPI
#### Add Stock
```
python AddStock.py
```
### Decrease Stock
```
python DecStock.py
```

### TESTED ON
- Raspberry PI 2 Model B+
- Windows 10
- RFID RC522



