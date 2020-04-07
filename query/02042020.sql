select id_submit_project, prj_name, prj_addrs,prj_dateline,status_project,project_last_modified, clnt_name,clnt_phone,clnt_email from mstr_project
inner join mstr_client on mstr_client.id_submit_client = mstr_project.id_client
where id_submit_project = 4 and status_project = 'ACTIVE';

select * from mstr_project;

select * from mstr_client;

select * from tbl_formula_combination;

select * from mstr_formula_attr WHERE TIPE_ATTR = 'upah'
delete from mstr_formula_attr where id_submit_formula_attr > 867