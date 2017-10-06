SELECT a.at_id AS id_inc, a.at_titulo AS titulo, a.at_descri AS descripcion, a.at_lugar AS lugar,
	a.at_respue AS respuesta, a.at_estado AS estado, a.at_fechoy AS fecha, p.pr_codigo AS codigo, 
	p.pr_nombre AS nombre, p.pr_email AS email
	from anomalias_tic a
	RIGHT OUTER JOIN profesores p ON p.pr_codigo = a.at_codpro;
	
