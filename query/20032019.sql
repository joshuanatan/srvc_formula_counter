drop table mstr_formula;
create table mstr_formula(
	id_submit_formula int primary key auto_increment,
    formula_name varchar(100),
    formula_desc varchar(300),
    formula_status varchar(10),
    formula_last_modified datetime,
    id_last_modified int
);
drop table mstr_formula_attr;
create table mstr_formula_attr(
	id_submit_formula_attr int primary key auto_increment,
    formula_attr_name varchar(100),
    harga_satuan_attr int,
    satuan_attr varchar(100),
    tipe_attr varchar(10) comment 'UPAH/ALAT/BAHAN',
    status_formula_attr varchar(10),
    formula_attr_last_modified datetime,
    id_last_modified int
);
drop table tbl_formula_combination;
create table tbl_formula_combination(
	id_submit_formula_comb int primary key auto_increment,
    id_mstr_formula int,
    id_formula_attr int,
    koefisien double(11,6),
    status_formula_comb varchar(10),
    formula_comb_last_modified datetime,
    id_last_modified int
);
drop table mstr_project;
create table mstr_project(
	id_submit_project int primary key auto_increment,
    prj_name varchar(100),
    prj_addrs varchar(300),
    prj_dateline date,
    id_client int,
    status_project varchar(10),
    project_last_modified datetime,
    id_last_modified int
);
create table mstr_client(
	id_submit_client int primary key auto_increment,
    clnt_name varchar(100),
	clnt_phone varchar(15),
	clnt_email varchar(100),
    status_clnt varchar(10),
	clnt_last_modified datetime,
	id_last_modified int
);
drop table tbl_project_rab;
create table tbl_project_rab(
	id_submit_rab int primary key auto_increment,
    id_formula int,
    id_project int,
    satuan_htg float,
    status_rab varchar(10),
    rab_last_modified datetime,
    id_last_modified int
);
create table mstr_formula_cat(
	id_submit_formula_cat int primary key auto_increment,
    formula_cat_name varchar(100),
    status_formula_cat varchar(10),
    formula_cat_last_modified datetime,
    id_last_modified int
);
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
)