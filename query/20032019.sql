create table mstr_formula(
	id_submit_formula int primary key auto_increment,
    formula_name varchar(100),
    formula_desc varchar(300),
    formula_status varchar(10),
    formula_last_modified datetime,
    id_last_modified int
);
create table mstr_formula_attr(
	id_submit_formula_attr int primary key auto_increment,
    formula_attr_name varchar(100),
    status_formula_attr varchar(10),
    formula_attr_last_modified datetime,
    id_last_modified int
);
create table tbl_formula_combination(
	id_submit_formula_comb int primary key auto_increment,
    id_mstr_formula int,
    id_formula_attr int,
    combination_formula varchar(100)
);

select * from mstr_formula;
select * from mstr_formula_attr;
select * from tbl_formula_combination;

select combination_formula,formula_attr_name 
from tbl_formula_combination 
inner join mstr_formula_attr on mstr_formula_attr.id_submit_formula_attr = tbl_formula_combination.id_formula_attr 
where id_mstr_formula = '1' and status_formula_attr = 'ACTIVE'

select * from tbl_formula_combination
inner join mstr_formula_attr on mstr_formula_attr.id_submit_formula_attr = tbl_formula_combination.id_formula_attr where id_mstr_formula = 1