#!/bin/bash

START=$(date +%s)

HOST="127.0.0.1"
USER="root" # MySQL User
PASSWD="170270" # MySQL password
BASE="sint_odessa"

date_old=$(mysql -u$USER -p$PASSWD -D$BASE -e "SELECT exchange as '' FROM exchanges WHERE id = 1") # Date old exchange

delimiter=','
quotes='"'

table_user='users'
table_user_profile='user_profiles'
table_order='orders'

#export_user='/var/www/sint.odessa/public/exchange/files/1c_user.csv'
export_order='/var/www/sint.odessa/public/exchange/files/1c_order.csv'
import_user='/var/www/sint.odessa/public/exchange/files/users1C.csv'
import_order='/var/www/sint.odessa/public/exchange/files/site_order.csv'

export_patch='/home/Work/port/website/site'
import_patch='/var/www/sint.odessa/public/exchange/files/1'

import_user=$import_patch/user$(date +"%Y%m%d%H%M").csv

 
echo $tt
# Import to 1C
mysql -u$USER -p$PASSWD -D$BASE -e "SELECT ${table_user}.id,1c_id,type_client_id,type_payment_id,client_name,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,${table_user_profile}.created_at,${table_user_profile}.updated_at,name,email FROM ${table_user_profile} LEFT JOIN ${table_user} ON ${table_user_profile}.user_id = ${table_user}.id WHERE ${table_user}.updated_at > '$date_old' OR ${table_user_profile}.updated_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${import_user}
#mysql -u$USER -p$PASSWD -D$BASE -e "SELECT id,user_id,1c_id,1cuser_id,type_order_id,type_client_id,client_name,user_company,phone,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,type_payment_id,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,comment,status_id,created_at,updated_at FROM ${table_order} WHERE created_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${export_order}

echo $date_old

#data_user=$(mysql -u$USER -p$PASSWD -D$BASE -e "SELECT ${table_user}.id,1c_id,type_client_id,type_payment_id,client_name,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,${table_user_profile}.created_at,${table_user_profile}.updated_at,name,email FROM ${table_user_profile} LEFT JOIN ${table_user} ON ${table_user_profile}.user_id = ${table_user}.id WHERE ${table_user}.updated_at > '$date_old' OR ${table_user_profile}.updated_at > '$date_old'")

#echo $data_user | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g"

count_user=$(mysql -u$USER -p$PASSWD -D$BASE -e "SELECT COUNT(*) AS '' FROM ${table_user_profile} LEFT JOIN ${table_user} ON ${table_user_profile}.user_id = ${table_user}.id WHERE ${table_user}.updated_at > '$date_old' OR ${table_user_profile}.updated_at > '$date_old'")

if [ "$count_user" -gt 0 ]
then

echo $count_user

mysql -u$USER -p$PASSWD -D$BASE -e "SELECT ${table_user}.id,1c_id,type_client_id,type_payment_id,client_name,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,${table_user_profile}.created_at,${table_user_profile}.updated_at,name,email FROM ${table_user_profile} LEFT JOIN ${table_user} ON ${table_user_profile}.user_id = ${table_user}.id WHERE ${table_user}.updated_at > '$date_old' OR ${table_user_profile}.updated_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${import_user}
fi



if [ "`ls ${import_patch}`" ] 
then 
	for i in ${import_patch}/*.csv
		do
  		echo $i
	done
fi



