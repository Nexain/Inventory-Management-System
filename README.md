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

## RUN API
### Windows
```
set FLASK_APP=api_all.py
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
#### POST - api/wh-log/decrease-stock
tag_id

## DRIVER RFID
#### Add Stock
```
python AddStock.py
```
### Decrease Stock
```
python DecStock.py
```




