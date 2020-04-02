app/ims/__init__.py
from flask import Blueprint

bp = Blueprint('ims', __name__)

from app.main import routes