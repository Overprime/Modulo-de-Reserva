/*QUERY ACTULIZACION DE COSTOS*/
UPDATE [020BDCOMUN].DBO.RESERVA_DET SET 
CANT_PEND=RD.CANTIDAD-D.REQ_CANTIDAD_DESPACHADA
FROM [011BDCOMUN].DBO.INV_REQMATERIAL_CAB AS C 
INNER JOIN [011BDCOMUN].DBO.INV_REQMATERIAL_DET AS D ON
C.REQ_NUMERO=D.REQ_NUMERO  INNER JOIN [020BDCOMUN].DBO.RESERVA_DET  AS RD
ON D.ACODIGO=RD.CODIGO AND C.REQ_NUMERO=RD.REQUERIMIENTO


-------------------------------------
SELECT (ROW_NUMBER() OVER(ORDER BY ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0)) DESC))AS ITEM,
DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,M.AUNIDAD,SUM(ISNULL(D.CANT_PEND,0)) AS CANT_RESERV,
ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0)) AS CANT_DISP
 FROM [020BDCOMUN].DBO.DATOS_RSV AS DRV LEFT JOIN 
[020BDCOMUN].DBO.RESERVA_DET AS D ON 
DRV.CODIGO=D.CODIGO INNER JOIN [011BDCOMUN].DBO.STKART AS S ON 
DRV.CODIGO=S.STCODIGO INNER JOIN [011BDCOMUN].DBO.MAEART AS M ON
DRV.CODIGO=M.ACODIGO  WHERE USUARIO='2' 
GROUP BY DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,M.AUNIDAD,S.STSKDIS

HAVING ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0))<=DRV.CANTIDAD  AND  
ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0))<>0


-----------------------------------------


SELECT (ROW_NUMBER() OVER(ORDER BY ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0)) DESC))AS ITEM,
DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,M.AUNIDAD,SUM(ISNULL(D.CANT_PEND,0)) AS CANT_RESERV,
ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0)) AS CANT_DISP
 FROM [020BDCOMUN].DBO.DATOS_RSV AS DRV LEFT JOIN 
[020BDCOMUN].DBO.RESERVA_DET AS D ON 
DRV.CODIGO=D.CODIGO INNER JOIN [011BDCOMUN].DBO.STKART AS S ON 
DRV.CODIGO=S.STCODIGO INNER JOIN [011BDCOMUN].DBO.MAEART AS M ON
DRV.CODIGO=M.ACODIGO  WHERE USUARIO='2' 
GROUP BY DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,M.AUNIDAD,S.STSKDIS

HAVING ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0))>=DRV.CANTIDAD  AND  
ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0))<>0


------------------------------------
QUERY  VALIDAR ESTADO DE LAS NOTAS DE INGRESO
--------------------------------------------

SELECT * FROM  [011BDCOMUN].DBO.COMOVC AS CC INNER JOIN [011BDCOMUN].DBO.MOVALMCAB AS MC 
ON CC.OC_CNUMORD=MC.CANUMORD AND CC.OC_ORDFAB=MC.CAORDFAB  INNER JOIN [020BDCOMUN].DBO.AUD_RQ AS A ON 
CC.OC_CNRODOCREF=A.NROREQUI  WHERE /*CC.OC_CNUMORD='0000000024405' AND*/ CC.OC_CSITORD IN ('03','04')AND OC_SOLICITA='89' AND
OC_CDOCREF='RQ' AND MC.CAALMA='01' AND MC.CATD='NI' AND CACODMOV='CL' AND OC_CCODMON='MN' 