
create table mstr_acc(
	id_submit_acc int primary key auto_increment,
    acc_name varchar(100),
    acc_email varchar(100),
    acc_pswd varchar(100),
    acc_phone varchar(15),
    acc_status varchar(10),
    acc_last_modified datetime,
    id_last_modified int
);