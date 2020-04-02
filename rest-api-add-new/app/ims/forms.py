/app/ims/forms.py
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField
from wtforms.validators import ValidationError, DataRequired
from flask_babel import _, lazt_gettext as _l

class AddNewProduct(FlaskForm):
    product_id = StringField(_l('Product ID'), validators=[DataRequired()])
    product_category = StringField(_l('Product Category'), validators=[DataRequired()])
    product_name = StringField(_l('Product Name'), validators=[DataRequired()])
    submit = SubmitField(_l('Add New Product'))
