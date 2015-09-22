|TABLAS NECESARIAS PARA TRABAJAR EL MODULO DE RESERVA

/*****************************************************/
TABLAS RESERVA DE MATERIALES
/****************************************************/
SELECT * FROM [020BDCOMUN].DBO.RESERVA_CAB

SELECT * FROM [020BDCOMUN].DBO.RESERVA_DET

/*****************************************************/
TABLAS REQUERIMIENTO DE MATERIALES
/****************************************************/
SELECT * FROM [011BDCOMUN].DBO.INV_REQMATERIAL_CAB

SELECT * FROM [011BDCOMUN].DBO.INV_REQMATERIAL_DET

/*****************************************************/
TABLA ASOCIACION CENTRO DE COSTO Y OT
/****************************************************/
SELECT * FROM [020BDCOMUN].DBO.CENCOSOT

/*****************************************************/
TABLA DOCUMENTOS NOTA DE INGRESO RESERVADA
/****************************************************/
SELECT * FROM [020BDCOMUN].DBO.DOCUMENTO

/*****************************************************/
TABLAS CORRELATIVOE DE REQ DE MATERIALES
/****************************************************/
SELECT * FROM [011BDCOMUN].DBO.NUM_DOCCOMPRAS WHERE CTNCODIGO='RM'

/*****************************************************/
TABLAS CARGA DE RESERVA EXCEL
/****************************************************/
SELECT * FROM [011BDCOMUN].DBO.DATOS_RSV


/*****************************************************/
TABLAS CORRELATIVOE DE RESERVAS
/****************************************************/
SELECT * FROM [020BDCOMUN].DBO.NUM_DOCCOMPRAS   WHERE CTNCODIGO='RM'


/*****************************************************/
TABLAS DE PRE_REQUERIMIENTO
/****************************************************/

SELECT * FROM [020BDCOMUN].DBO.PRE_REQUISD 

/*****************************************************/
TABLAS DE AUDITORIA DE REQUERIMIENTO
/****************************************************/
SELECT NROREQUI,CODSOLIC,TIPOREQUI,USUARIO,FECHA,ESTADO FROM AUD_RQ

-----------------------------------------------------

REINICIO DE TABLAS
-----------------------------------------------------
 TRUNCATE TABLE [020BDCOMUN].DBO.RESERVA_DET

TRUNCATE TABLE [020BDCOMUN].DBO.RESERVA_CAB

TRUNCATE TABLE [020BDCOMUN].DBO.DOCUMENTO

TRUNCATE TABLE [020BDCOMUN].DBO.CENCOSOT

TRUNCATE TABLE [011BDCOMUN].DBO.INV_REQMATERIAL_CAB

TRUNCATE TABLE [011BDCOMUN].DBO.INV_REQMATERIAL_DET

UPDATE [011BDCOMUN].DBO.NUM_DOCCOMPRAS SET CTNNUMERO=0 WHERE  CTNCODIGO='RM' 

UPDATE [020BDCOMUN].DBO.NUM_DOCCOMPRAS SET  CTNNUMERO='0' WHERE CTNCODIGO='RV' 

TRUNCATE TABLE [020BDCOMUN].DBO.DATOS_RSV

TRUNCATE TABLE [020BDCOMUN].DBO.PRE_REQUISD
TRUNCATE TABLE [020BDCOMUN].DBO.AUD_RQ








