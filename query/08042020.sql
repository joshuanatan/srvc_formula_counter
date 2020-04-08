create table mstr_supplier(
	id_submit_supplier int primary key auto_increment,
	nama_supp varchar(100),
	alamat_supp varchar(300),
	pic_supp varchar(100),
	notelp_supp varchar(15),
	supp_status varchar(10),
	supp_last_modified datetime,
	id_last_modified int
)