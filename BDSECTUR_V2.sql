drop database if exists sectur;
create database if not exists sectur;
use sectur;

/*-------------------------Tablas-------------------------------*/


create table if not exists tipoUsuario(
idTipoUsuario int not null auto_increment,
nombreTipo varchar(30),
constraint pk_idTipoUser primary key(idTipoUsuario)
);

create table if not exists disciplina(
idDisciplina int not null auto_increment,
nombre varchar(30)not null,
descripcion varchar(120),
estatus char(1),
constraint pk_idDisciplina primary key(idDisciplina));

CREATE TABLE if not exists persona(
idPersona int auto_increment  NOT NULL,
genero char(1) NOT NULL,
nombre varchar(50)  NOT NULL,
apellidos varchar(50)  NOT NULL,
edad int NOT NULL,
fotoPersona varchar(200) NOT NULL,
fotoIdentificacion varchar(200) NOT NULL,
correo varchar(100) NOT NULL,
estatus char(1),
constraint pk_idPersona primary key(idPersona)
) CHARSET = latin1;

CREATE TABLE if not exists usuario (
  idUsuario int(11) NOT NULL AUTO_INCREMENT,
  tipo int NOT NULL,
  usuario varchar(100) NOT NULL,
  contrasenhia varchar(100) NOT NULL,
  estatus char(1)not null,
  PRIMARY KEY (idUsuario),
  constraint fk_tipoUsuar foreign key(tipo) references tipoUsuario(idTipoUsuario)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

create table if not exists grupo(
idGrupo int not null auto_increment,
idUsuario int NOT NULL,
IdDisciplina int not null,
nombre varchar(50),
clave varchar(30),
folio varchar(20),
num_personas int,
constraint pk_idGrupo primary key(idGrupo),
constraint fk_idUusario foreign key(idUsuario) references usuario(idUsuario),
constraint fk_idDisciplina foreign key(IdDisciplina) references disciplina(idDisciplina))charset=latin1;

create table if not exists participante(
idParticipante int not null auto_increment,
idGrupo int not null,
esAnfitrion char(1) NOT NULL,
idPersona int not null,
constraint pk_idParticipantes primary key(idParticipante),
constraint fk_idGrupo foreign key(idGrupo) references grupo(idGrupo),
constraint fk_idPersona2 foreign key(idPersona) references persona(idPersona)
);


create table if not exists anfitrion(
idAnfitrion int NOT NULL auto_increment,
idParticipante int NOT NULL,
fecha date NOT NULL,
constraint pk_idAnf primary key(idAnfitrion),
constraint fk_idParticipant1 foreign key(idParticipante) references participante(idParticipante)
);

create table if not exists subgrupo(
idSubgrupo int not null auto_increment,
idGrupo int not null ,
subFolio varchar(20),
fecha date not null,
constraint pk_idSubGrupo primary key(idSubgrupo),
constraint fk_idGrupo2 foreign key(idGrupo) references grupo(idGrupo))charset=latin1;

create table if not exists presupuesto(
idPresu int not null auto_increment,
montoAlimen double not null,
montoHosped double not null,
fechaIn date not null,
fechaFin date not null,
estatus char(1),
constraint pk_idMeta primary key(idPresu));

create table if not exists hotel(
idHotel int not null auto_increment,
nombre varchar(100)not null,
estatus char(1),
constraint pk_idHotel primary key(idHotel))charset=latin1;

create table if not exists tipoHabitacion(
idTipoHab int auto_increment not null,
idHotel int not null,
nombTipo varchar(10),
costo double,
constraint pk_idTipoHab primary key(idTipoHab),
constraint fk_idHotel1 foreign key(idHotel)references hotel(idHotel)
)charset = latin1;

create table if not exists estancia(
idEstancia int not null auto_increment,
idSubgrupo int not null,
fechaEntrada varchar(15)not null,
fechaSalida varchar(15)not null,
idHotel int not null,
tarifa double not null,
num_habitaciones int not null,
num_noches int not null,
tipo_habitacion int not null,
total double not null,
constraint pk_idEstancia primary key(idEstancia),
constraint fk_idHotel foreign key(idHotel)references hotel(idHotel),
constraint fk_idSubGrup foreign key(idSubgrupo)references subgrupo(idSubgrupo))charset=latin1;

create table if not exists nivelTarj(
idNivel int auto_increment not null,
nivel int not null,
montoNivel int not null,
estatus char(1) not null,
constraint pk_idNivel primary key(idNivel)
);

create table if not exists tarjeta(
idTarjeta int not null auto_increment,
idParticipante int not null,
idNivel int not null,
codigo varchar(30) null,
nip varchar(200) null,
monto double null,
estatus char(1),
constraint pk_idTarjeta primary key(idTarjeta),
constraint fk_idParticipante2 foreign key(idParticipante) references participante(idParticipante),
constraint fk_idNivel foreign key(idNivel) references nivelTarj(idNivel)
)charset=latin1;

drop table if exists movimientoTarjeta;
create table if not exists movimientoTarjeta(
idMovimiento int not null auto_increment,
idTarjeta int not null,
ticket varchar(30) not null,
fecha date,
constraint pk_idMovimiento primary key(idMovimiento),
constraint fk_idTarjeta foreign key(idTarjeta) references tarjeta(idTarjeta))charset=latin1;


create database ejemplo;
use ejemplo;
insert into gastos values(0,1);
drop table gastos;


create table gastos(
id int primary key auto_increment,
saldo double
);
SET GLOBAL event_scheduler = ON;
drop EVENT e_ActualizaSaldoDiario;
CREATE EVENT e_ActualizaSaldoDiario
ON SCHEDULE EVERY 1 SECOND STARTS now()
DO UPDATE gastos SET saldo = saldo+1000 WHERE id > 0;
select *from gastos;
SHOW PROCESSLIST;
/*-------------------------Vistas-------------------------------*/
create view grupo_anfitrion as
select g.idGrupo,g.idAnfitrion,g.nombre,g.clave,g.folio,g.num_personas,a.nombre as
 antitrion,a.categoria,a.pais,a.disciplina from grupo g inner join anfitrion a on g.idAnfitrion=a.idAnfitrion;

create view hospedaje as select  g.idGrupo,g.folio as folioGrupo,e.*,s.folio as 
folioSubGrupo from estancia e inner join subgrupo s on e.idSubgrupo=s.idSubgrupo inner join 
grupo g on s.idGrupo=g.idGrupo;

drop view if exists movimiento_usuario;
create view movimiento_usuario as select a.*,d.servicio,d.detalle,d.subtotal from anfitrion a inner join tarjeta t on a.idAnfitrion=t.idAnfitrion inner join movimientotarjeta m on t.idTarjeta=m.idTarjeta inner join detallemovimiento d on m.idMovimiento=d.idMovimiento;

drop view if exists anfitrion_tarjeta;
create view anfitrion_tarjeta as select a.*,t.idTarjeta,t.codigo,t.nip,t.monto,t.estatus,(t.monto-(select case when sum(subtotal)is null then 0 else sum(subtotal)end from movimiento_usuario mu where a.idAnfitrion=mu.idAnfitrion)) as disponible from anfitrion a inner join tarjeta t on a.idAnfitrion=t.idAnfitrion;

/*-------------------------Inserts-------------------------------*/
insert into usuario values(null,'Administrador',9,'admin','f865b53623b121fd34ee5426c792e5c33af8c227',1);

/*-------------------------Pruebas-------------------------------*/

desc estancia;
insert into estancia values(null,idSubgrupo,fechaEntrada,fechaSalida,hotel,tarifa,num_habitaciones,num_noches,tipo_habitacion,total);
select *,(select (m.monto-sum(total)) from estancia e) from monto_meta m where estatus=1;
select *from monto_meta;
select *from anfitrion;
select *from grupo;
select *from tarjeta;
select *from estancia;
select *from grupo_anfitrion;
create view grupo_anfitrion as
select g.idGrupo,g.idAnfitrion,g.nombre,g.clave,g.folio,g.num_personas,a.nombre as antitrion,a.categoria,a.pais,a.disciplina from grupo g inner join anfitrion a on g.idAnfitrion=a.idAnfitrion;
select  g.idGrupo,g.folio as folioGrupo,e.*,s.folio as folioSubGrupo from estancia e inner join subgrupo s on e.idSubgrupo=s.idSubgrupo inner join grupo g on s.idGrupo=g.idGrupo;
drop view hospedaje;


select * from grupo_anfitrion where idAnfitrion=1;
select *,(select (m.monto-IFNULL(sum(total),0)) from estancia e) from monto_meta m where estatus=1;
select case when codigo_barra='650003011' then 'Registro Encontrado' else ' ' end;

desc tarjeta;
alter table estancia add constraint fk_idHotel2 foreign key(hotel) references hotel(idHotel);
select *from anfitrion_tarjeta;
select *from movimiento_usuario;
select *from tarjeta;
select codigo from tarjeta where codigo='0016049367';
select (case when count(idTarjeta)=0 then 0 else 1 end) as cantidad from tarjeta where codigo='0016054127';
update tarjeta set codigo='0016049364',nip='1234',monto=1250,estatus=1 where idTarjeta=1  and '0016049364'!=(select codigo from (select *from tarjeta) as m2 where codigo='0016049364');
select a.*,t.idTarjeta,t.codigo,t.nip,t.monto,t.estatus,t.monto as disponible,d.subtotal from anfitrion a inner join tarjeta t on a.idAnfitrion=t.idAnfitrion 
inner join movimientotarjeta m on t.idTarjeta=m.idTarjeta inner join detallemovimiento d on m.idMovimiento=d.idMovimiento;

select (case when count(idTarjeta)=0 then 0 else 1 end) as cantidad from tarjeta where codigo='0016049372' ;
select (case when count(idTarjeta)=0 then 0 else 1 end) as cantidad from tarjeta where codigo='0016049372' and idAnfitrion!=2;
desc grupo;
desc hotel;

select *from tarjeta;