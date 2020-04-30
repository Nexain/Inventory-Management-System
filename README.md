# polban-ims
Inventory - Automation Product Detection System

## Anggota kelompok
- Afif Rana Muhammad 	(171524001)
- Ahmad Aji Naufal Ali 	(171524002)
- Alifia Syalsabila
- Mumuh Kustino Muharram
- Muhammad Salman Al Hafizh
- Sophia Gianina Daeli

## Akun 000Webhost
email : imandasr99@gmail.com
pwd   :anisette

## Database
we are using local database instead of domain hosting for development phase

## HOW TO RUN
- Install MySQL, Python, Flask
- Run MySQL
- Run API on your PC
- Run RFID Driver on your Raspi
- If eror encountered, please try to fix it (it works on us :) )

## RUN API
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



