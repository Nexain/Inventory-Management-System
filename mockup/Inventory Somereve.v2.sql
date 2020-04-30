/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     3/12/2020 3:04:05 PM                         */
/*==============================================================*/


alter table LOG 
   drop foreign key FK_LOG_CONTAIN_PRODUCTS;

alter table LOG 
   drop foreign key FK_LOG_MEMILIKI_WAREHOUS;

alter table PRODUCTS 
   drop foreign key FK_PRODUCTS_MERUPAKAN_CATEGORY;

alter table WAREHOUSE_STOCK 
   drop foreign key FK_WAREHOUS_RELATIONS_WAREHOUS;

alter table WAREHOUSE_STOCK 
   drop foreign key FK_WAREHOUS_RELATIONS_PRODUCTS;

drop table if exists CATEGORY;


alter table LOG 
   drop foreign key FK_LOG_CONTAIN_PRODUCTS;

alter table LOG 
   drop foreign key FK_LOG_MEMILIKI_WAREHOUS;

drop table if exists LOG;


alter table PRODUCTS 
   drop foreign key FK_PRODUCTS_MERUPAKAN_CATEGORY;

drop table if exists PRODUCTS;

drop table if exists WAREHOUSE;


alter table WAREHOUSE_STOCK 
   drop foreign key FK_WAREHOUS_RELATIONS_WAREHOUS;

alter table WAREHOUSE_STOCK 
   drop foreign key FK_WAREHOUS_RELATIONS_PRODUCTS;

drop table if exists WAREHOUSE_STOCK;

/*==============================================================*/
/* Table: CATEGORY                                              */
/*==============================================================*/
create table CATEGORY
(
   CATEGORY_ID          varchar(10) not null  comment '',
   NAME_CATEGORY        varchar(32)  comment '',
   primary key (CATEGORY_ID)
);

/*==============================================================*/
/* Table: LOG                                                   */
/*==============================================================*/
create table LOG
(
   TAG_ID               varchar(10) not null  comment '',
   PRODUCT_ID           varchar(10) not null  comment '',
   WH_ID                varchar(10) not null  comment '',
   DATE_IN              timestamp  comment '',
   DATE_OUT             timestamp  comment '',
   primary key (TAG_ID)
);

/*==============================================================*/
/* Table: PRODUCTS                                              */
/*==============================================================*/
create table PRODUCTS
(
   PRODUCT_ID           varchar(10) not null  comment '',
   CATEGORY_ID          varchar(10) not null  comment '',
   PRODUCT_NAME         varchar(32)  comment '',
   primary key (PRODUCT_ID)
);

/*==============================================================*/
/* Table: WAREHOUSE                                             */
/*==============================================================*/
create table WAREHOUSE
(
   WH_ID                varchar(10) not null  comment '',
   WH_LOCATION          varchar(32)  comment '',
   primary key (WH_ID)
);

/*==============================================================*/
/* Table: WAREHOUSE_STOCK                                       */
/*==============================================================*/
create table WAREHOUSE_STOCK
(
   PRODUCT_ID           varchar(10)  comment '',
   WH_ID                varchar(10)  comment '',
   STOCK                int  comment ''
);

alter table LOG add constraint FK_LOG_CONTAIN_PRODUCTS foreign key (PRODUCT_ID)
      references PRODUCTS (PRODUCT_ID) on delete restrict on update restrict;

alter table LOG add constraint FK_LOG_MEMILIKI_WAREHOUS foreign key (WH_ID)
      references WAREHOUSE (WH_ID) on delete restrict on update restrict;

alter table PRODUCTS add constraint FK_PRODUCTS_MERUPAKAN_CATEGORY foreign key (CATEGORY_ID)
      references CATEGORY (CATEGORY_ID) on delete restrict on update restrict;

alter table WAREHOUSE_STOCK add constraint FK_WAREHOUS_RELATIONS_WAREHOUS foreign key (WH_ID)
      references WAREHOUSE (WH_ID) on delete restrict on update restrict;

alter table WAREHOUSE_STOCK add constraint FK_WAREHOUS_RELATIONS_PRODUCTS foreign key (PRODUCT_ID)
      references PRODUCTS (PRODUCT_ID) on delete restrict on update restrict;

