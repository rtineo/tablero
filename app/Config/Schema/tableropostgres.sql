--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: clean_ids(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION clean_ids() RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE 
allOkey integer default 1;
BEGIN
PERFORM setval('acos_id_seq', (SELECT MAX(id) FROM acos)+1);
PERFORM setval('aros_id_seq', (SELECT MAX(id) FROM aros)+1);
PERFORM setval('aros_acos_id_seq', (SELECT MAX(id) FROM aros_acos)+1);
PERFORM setval('basicstatus_id_seq', (SELECT MAX(id) FROM basicstatus)+1);
PERFORM setval('secassigns_id_seq', (SELECT MAX(id) FROM secassigns)+1);
PERFORM setval('secorganizations_id_seq', (SELECT MAX(id) FROM secorganizations)+1);
PERFORM setval('secpasswords_id_seq', (SELECT MAX(id) FROM secpasswords)+1);
PERFORM setval('secpeople_id_seq', (SELECT MAX(id) FROM secpeople)+1);
PERFORM setval('secprograms_id_seq', (SELECT MAX(id) FROM secprograms)+1);
PERFORM setval('secprojects_id_seq', (SELECT MAX(id) FROM secprojects)+1);
PERFORM setval('secroles_id_seq', (SELECT MAX(id) FROM secroles)+1);
PERFORM setval('worclients_id_seq', (SELECT MAX(id) FROM worclients)+1);
PERFORM setval('worcurrencies_id_seq', (SELECT MAX(id) FROM worcurrencies)+1);
PERFORM setval('wordocuments_id_seq', (SELECT MAX(id) FROM wordocuments)+1);
PERFORM setval('wordocumenttypes_id_seq', (SELECT MAX(id) FROM wordocumenttypes)+1);
PERFORM setval('wordollartypechanges_id_seq', (SELECT MAX(id) FROM wordollartypechanges)+1);
PERFORM setval('worentrynotedetails_id_seq', (SELECT MAX(id) FROM worentrynotedetails)+1);
PERFORM setval('worentrynotes_id_seq', (SELECT MAX(id) FROM worentrynotes)+1);
PERFORM setval('worentrynotes_worparameters_id_seq', (SELECT MAX(id) FROM worentrynotes_worparameters)+1);
PERFORM setval('worestimatedetails_id_seq', (SELECT MAX(id) FROM worestimatedetails)+1);
PERFORM setval('worestimates_id_seq', (SELECT MAX(id) FROM worestimates)+1);
PERFORM setval('worestimatestatus_id_seq', (SELECT MAX(id) FROM worestimatestatus)+1);
PERFORM setval('worinsurances_id_seq', (SELECT MAX(id) FROM worinsurances)+1);
PERFORM setval('worinvoicedetails_id_seq', (SELECT MAX(id) FROM worinvoicedetails)+1);
PERFORM setval('worinvoices_id_seq', (SELECT MAX(id) FROM worinvoices)+1);
PERFORM setval('workardexes_id_seq', (SELECT MAX(id) FROM workardexes)+1);
PERFORM setval('worothers_id_seq', (SELECT MAX(id) FROM worothers)+1);
PERFORM setval('woroutputticketdetails_id_seq', (SELECT MAX(id) FROM woroutputticketdetails)+1);
PERFORM setval('woroutputtickets_id_seq', (SELECT MAX(id) FROM woroutputtickets)+1);
PERFORM setval('woroutputtickets_worparameters_id_seq', (SELECT MAX(id) FROM woroutputtickets_worparameters)+1);
PERFORM setval('worparameters_id_seq', (SELECT MAX(id) FROM worparameters)+1);
PERFORM setval('worpaymenttipes_id_seq', (SELECT MAX(id) FROM worpaymenttipes)+1);
PERFORM setval('worpurchaseorderdetails_id_seq', (SELECT MAX(id) FROM worpurchaseorderdetails)+1);
PERFORM setval('worpurchaseorders_id_seq', (SELECT MAX(id) FROM worpurchaseorders)+1);
PERFORM setval('worpurchaseorderstatus_id_seq', (SELECT MAX(id) FROM worpurchaseorderstatus)+1);
PERFORM setval('worreasons_id_seq', (SELECT MAX(id) FROM worreasons)+1);
PERFORM setval('worseries_id_seq', (SELECT MAX(id) FROM worseries)+1);
PERFORM setval('worservices_id_seq', (SELECT MAX(id) FROM worservices)+1);
PERFORM setval('worservicetipes_id_seq', (SELECT MAX(id) FROM worservicetipes)+1);
PERFORM setval('worspareparts_id_seq', (SELECT MAX(id) FROM worspareparts)+1);
PERFORM setval('worstocks_id_seq', (SELECT MAX(id) FROM worstocks)+1);
PERFORM setval('worsuppliers_id_seq', (SELECT MAX(id) FROM worsuppliers)+1);
PERFORM setval('worubigeos_id_seq', (SELECT MAX(id) FROM worubigeos)+1);
PERFORM setval('worvehicles_id_seq', (SELECT MAX(id) FROM worvehicles)+1);
PERFORM setval('worwarehouses_id_seq', (SELECT MAX(id) FROM worwarehouses)+1);
PERFORM setval('worworkorderdetails_id_seq', (SELECT MAX(id) FROM worworkorderdetails)+1);
PERFORM setval('worworkorders_id_seq', (SELECT MAX(id) FROM worworkorders)+1);
PERFORM setval('worworkorderstatus_id_seq', (SELECT MAX(id) FROM worworkorderstatus)+1);
PERFORM setval('woworkordersdetails_id_seq', (SELECT MAX(id) FROM woworkordersdetails)+1);

return 1;
END;
$$;


ALTER FUNCTION public.clean_ids() OWNER TO postgres;

--
-- Name: acos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE acos_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acos (
    id integer DEFAULT nextval('acos_id_seq'::regclass) NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT ''::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT ''::character varying,
    lft integer,
    rght integer,
    paramenu integer
);


ALTER TABLE acos OWNER TO postgres;

--
-- Name: aros_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE aros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE aros_id_seq OWNER TO postgres;

--
-- Name: aros; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE aros (
    id integer DEFAULT nextval('aros_id_seq'::regclass) NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT ''::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT ''::character varying,
    lft integer,
    rght integer
);


ALTER TABLE aros OWNER TO postgres;

--
-- Name: aros_acos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE aros_acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE aros_acos_id_seq OWNER TO postgres;

--
-- Name: aros_acos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE aros_acos (
    id integer DEFAULT nextval('aros_acos_id_seq'::regclass) NOT NULL,
    aro_id integer NOT NULL,
    aco_id integer NOT NULL,
    _create integer DEFAULT 0 NOT NULL,
    _read integer DEFAULT 0 NOT NULL,
    _update integer DEFAULT 0 NOT NULL,
    _delete integer DEFAULT 0 NOT NULL
);


ALTER TABLE aros_acos OWNER TO postgres;

--
-- Name: basicstatus_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE basicstatus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE basicstatus_id_seq OWNER TO postgres;

--
-- Name: basicstatus; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE basicstatus (
    id integer DEFAULT nextval('basicstatus_id_seq'::regclass) NOT NULL,
    shortname character varying(45),
    name character varying(250)
);


ALTER TABLE basicstatus OWNER TO postgres;

--
-- Name: secassigns_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secassigns_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secassigns_id_seq OWNER TO postgres;

--
-- Name: secassigns; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secassigns (
    id integer DEFAULT nextval('secassigns_id_seq'::regclass) NOT NULL,
    secrole_id integer NOT NULL,
    secproject_id integer NOT NULL,
    secperson_id integer NOT NULL,
    status character varying(2) DEFAULT 'AC'::character varying NOT NULL,
    fixticio character varying(100) DEFAULT '984413ed80913491eb3a1b7fb06bb8cf453dff72'::character varying
);


ALTER TABLE secassigns OWNER TO postgres;

--
-- Name: secconfigurations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secconfigurations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secconfigurations_id_seq OWNER TO postgres;

--
-- Name: secconfigurations; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secconfigurations (
    id integer DEFAULT nextval('secconfigurations_id_seq'::regclass) NOT NULL,
    minpasswordlength integer DEFAULT 0 NOT NULL,
    passwordtimelife integer DEFAULT 0 NOT NULL,
    previouspasswordlimit integer DEFAULT 0 NOT NULL
);


ALTER TABLE secconfigurations OWNER TO postgres;

--
-- Name: secorganizations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secorganizations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secorganizations_id_seq OWNER TO postgres;

--
-- Name: secorganizations; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secorganizations (
    id integer DEFAULT nextval('secorganizations_id_seq'::regclass) NOT NULL,
    code character varying(25) NOT NULL,
    name character varying(25) NOT NULL,
    type integer,
    theme character varying(25) DEFAULT NULL::character varying,
    texto character varying(255) DEFAULT NULL::character varying,
    address character varying(60) DEFAULT NULL::character varying,
    ruc character varying(20) DEFAULT NULL::character varying,
    photo1 character varying(60) DEFAULT NULL::character varying,
    photo2 character varying(60) DEFAULT NULL::character varying,
    phone character varying(20) DEFAULT NULL::character varying,
    status character varying(2) DEFAULT 'AC'::character varying,
    view_boleta character varying(100) DEFAULT 'get_pdf_boleta'::character varying,
    view_factura character varying(100) DEFAULT 'get_pdf_factura'::character varying,
    directoriofirma character varying(60),
    view_recibo character varying(100) DEFAULT 'get_pdf_recibo'::character varying
);


ALTER TABLE secorganizations OWNER TO postgres;

--
-- Name: secpasswords_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secpasswords_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secpasswords_id_seq OWNER TO postgres;

--
-- Name: secpasswords; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secpasswords (
    id integer DEFAULT nextval('secpasswords_id_seq'::regclass) NOT NULL,
    secperson_id integer NOT NULL,
    password character varying(250) NOT NULL,
    creationdatetime date,
    status character varying(2) DEFAULT 'AC'::character varying NOT NULL
);


ALTER TABLE secpasswords OWNER TO postgres;

--
-- Name: secpeople_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secpeople_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secpeople_id_seq OWNER TO postgres;

--
-- Name: secpeople; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secpeople (
    id integer DEFAULT nextval('secpeople_id_seq'::regclass) NOT NULL,
    firstname character varying(60) NOT NULL,
    appaterno character varying(60) NOT NULL,
    apmaterno character varying(60) NOT NULL,
    privelege integer,
    username character varying(20) NOT NULL,
    email character varying(255),
    status character varying(2) DEFAULT 'AC'::character varying NOT NULL,
    creationdate date,
    expirationdate date,
    password character varying(250) DEFAULT '08423b9c8b450fb260c6bbc7af96da35c54cf145'::character varying,
    address character varying(255),
    language character varying(20),
    archivofisico character varying(250),
    archivo character varying(250)
);


ALTER TABLE secpeople OWNER TO postgres;

--
-- Name: secprograms_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secprograms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secprograms_id_seq OWNER TO postgres;

--
-- Name: secprograms; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secprograms (
    id integer DEFAULT nextval('secprograms_id_seq'::regclass) NOT NULL,
    aro_id integer NOT NULL,
    aco_id integer,
    parent_id integer,
    lft integer,
    rght integer,
    etiqueta character varying(100)
);


ALTER TABLE secprograms OWNER TO postgres;

--
-- Name: secprojects_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secprojects_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secprojects_id_seq OWNER TO postgres;

--
-- Name: secprojects; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secprojects (
    id integer DEFAULT nextval('secprojects_id_seq'::regclass) NOT NULL,
    secorganization_id integer NOT NULL,
    code character varying(25) NOT NULL,
    name character varying(100) NOT NULL,
    photo1 character varying(60),
    text1 character varying(250),
    status character varying(2) DEFAULT 'AC'::character varying NOT NULL,
    direccion character varying(255),
    telefono character varying(20)
);


ALTER TABLE secprojects OWNER TO postgres;

--
-- Name: secroles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secroles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE secroles_id_seq OWNER TO postgres;

--
-- Name: secroles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE secroles (
    id integer DEFAULT nextval('secroles_id_seq'::regclass) NOT NULL,
    secorganization_id integer NOT NULL,
    code character varying(5) NOT NULL,
    name character varying(60) NOT NULL,
    status character varying(2) DEFAULT 'AC'::character varying NOT NULL
);


ALTER TABLE secroles OWNER TO postgres;

--
-- Data for Name: acos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY acos (id, parent_id, model, foreign_key, alias, lft, rght, paramenu) FROM stdin;
57	38	\N	\N	getDia	111	112	\N
35	24	\N	\N	getSessionConditions	67	68	\N
3	2	\N	\N	home	3	4	\N
73	68	\N	\N	add	143	144	\N
4	2	\N	\N	manualdeusuario	5	6	\N
38	1	\N	\N	Secassigns	74	115	\N
36	24	\N	\N	getDia	69	70	\N
5	2	\N	\N	display	7	8	\N
58	38	\N	\N	getMes	113	114	\N
6	2	\N	\N	datosAuditoria	9	10	\N
24	1	\N	\N	Secaccesses	46	73	\N
37	24	\N	\N	getMes	71	72	\N
7	2	\N	\N	setInitSessionConditions	11	12	\N
8	2	\N	\N	setSessionConditions	13	14	\N
9	2	\N	\N	getSessionConditions	15	16	\N
84	68	\N	\N	setParametrosNi	165	166	\N
10	2	\N	\N	getDia	17	18	\N
39	38	\N	\N	login	75	76	\N
2	1	\N	\N	Pages	2	21	\N
11	2	\N	\N	getMes	19	20	\N
74	68	\N	\N	edit	145	146	\N
40	38	\N	\N	indexEmailIngresoProductoTerminado	77	78	\N
13	12	\N	\N	constructor	23	24	\N
60	59	\N	\N	configuration	117	118	\N
41	38	\N	\N	recibirEmailIngresoProductoTerminadoToggle	79	80	\N
15	12	\N	\N	editar	27	28	\N
16	12	\N	\N	agregar	29	30	\N
42	38	\N	\N	permisoparaaprobar	81	82	\N
17	12	\N	\N	eliminar	31	32	\N
61	59	\N	\N	volverLassequencias	119	120	\N
18	12	\N	\N	datosAuditoria	33	34	\N
43	38	\N	\N	aprobarcorreo	83	84	\N
19	12	\N	\N	setInitSessionConditions	35	36	\N
20	12	\N	\N	setSessionConditions	37	38	\N
75	68	\N	\N	delete	147	148	\N
44	38	\N	\N	asignacion	85	86	\N
21	12	\N	\N	getSessionConditions	39	40	\N
62	59	\N	\N	datosAuditoria	121	122	\N
22	12	\N	\N	getDia	41	42	\N
12	1	\N	\N	Acos	22	45	\N
23	12	\N	\N	getMes	43	44	\N
45	38	\N	\N	listprojects	87	88	\N
85	68	\N	\N	datosAuditoria	167	168	\N
25	24	\N	\N	permiso	47	48	\N
46	38	\N	\N	listroles	89	90	\N
63	59	\N	\N	setInitSessionConditions	123	124	\N
27	24	\N	\N	listapermisos	51	52	\N
47	38	\N	\N	logout	91	92	\N
28	24	\N	\N	accederpermiso	53	54	\N
76	68	\N	\N	mostrarroles	149	150	\N
29	24	\N	\N	permitir	55	56	\N
30	24	\N	\N	denegarpermiso	57	58	\N
64	59	\N	\N	setSessionConditions	125	126	\N
31	24	\N	\N	cancelar	59	60	\N
49	38	\N	\N	view	95	96	\N
32	24	\N	\N	datosAuditoria	61	62	\N
93	91	\N	\N	view	183	184	\N
33	24	\N	\N	setInitSessionConditions	63	64	\N
65	59	\N	\N	getSessionConditions	127	128	\N
34	24	\N	\N	setSessionConditions	65	66	\N
50	38	\N	\N	add	97	98	\N
77	68	\N	\N	mostrarsucursales	151	152	\N
51	38	\N	\N	edit	99	100	\N
66	59	\N	\N	getDia	129	130	\N
52	38	\N	\N	delete	101	102	\N
59	1	\N	\N	Secconfigurations	116	133	\N
53	38	\N	\N	datosAuditoria	103	104	\N
67	59	\N	\N	getMes	131	132	\N
54	38	\N	\N	setInitSessionConditions	105	106	\N
86	68	\N	\N	setInitSessionConditions	169	170	\N
55	38	\N	\N	setSessionConditions	107	108	\N
56	38	\N	\N	getSessionConditions	109	110	\N
99	91	\N	\N	setSessionConditions	195	196	\N
69	68	\N	\N	index	135	136	\N
79	68	\N	\N	asignacionexcesocomite	155	156	\N
70	68	\N	\N	logisticaindex	137	138	\N
87	68	\N	\N	setSessionConditions	171	172	\N
71	68	\N	\N	logisticaedit	139	140	\N
80	68	\N	\N	asignacionCorreoCancelaciones	157	158	\N
72	68	\N	\N	view	141	142	\N
94	91	\N	\N	add	185	186	\N
88	68	\N	\N	getSessionConditions	173	174	\N
81	68	\N	\N	indexProduccion	159	160	\N
82	68	\N	\N	setParametrosProduccion	161	162	\N
89	68	\N	\N	getDia	175	176	\N
83	68	\N	\N	indexNotaIngreso	163	164	\N
95	91	\N	\N	edit	187	188	\N
100	91	\N	\N	getSessionConditions	197	198	\N
68	1	\N	\N	Secorganizations	134	179	\N
90	68	\N	\N	getMes	177	178	\N
96	91	\N	\N	delete	189	190	\N
104	103	\N	\N	modificarpasswordusuario	205	206	\N
92	91	\N	\N	index	181	182	\N
101	91	\N	\N	getDia	199	200	\N
97	91	\N	\N	datosAuditoria	191	192	\N
107	103	\N	\N	view	211	212	\N
98	91	\N	\N	setInitSessionConditions	193	194	\N
105	103	\N	\N	modificarpassword	207	208	\N
91	1	\N	\N	Secpasswords	180	203	\N
102	91	\N	\N	getMes	201	202	\N
109	103	\N	\N	edit	215	216	\N
114	103	\N	\N	jpersonabuscar	225	226	\N
111	103	\N	\N	getUserListaJson	219	220	\N
108	103	\N	\N	add	213	214	\N
113	103	\N	\N	jsdatospersona	223	224	\N
110	103	\N	\N	delete	217	218	\N
112	103	\N	\N	getVendedorListaJson	221	222	\N
115	103	\N	\N	datosAuditoria	227	228	\N
116	103	\N	\N	setInitSessionConditions	229	230	\N
117	103	\N	\N	setSessionConditions	231	232	\N
118	103	\N	\N	getSessionConditions	233	234	\N
119	103	\N	\N	getDia	235	236	\N
120	103	\N	\N	getMes	237	238	\N
395	1		\N	Woroldworkorderdetails	794	797	0
402	371		\N	getPdfPen	787	788	0
48	38	\N	\N	index	93	94	1
106	103	\N	\N	index	209	210	1
26	24	\N	\N	listaccess	49	50	1
103	1	\N	\N	Secpeople	204	241	\N
400	103		\N	runProcess	239	240	1
1	\N	\N	\N	controllers	1	798	\N
14	12	\N	\N	index	25	26	1
78	68	\N	\N	menuseguridad	153	154	1
122	121	\N	\N	add	243	244	\N
123	121	\N	\N	listprograms	245	246	\N
124	121	\N	\N	index	247	248	\N
125	121	\N	\N	view	249	250	\N
126	121	\N	\N	edit	251	252	\N
121	1	\N	\N	Secprograms	242	271	\N
161	150	\N	\N	getMes	321	322	\N
127	121	\N	\N	delete	253	254	\N
128	121	\N	\N	down	255	256	\N
200	197	\N	\N	setInitSessionConditions	399	400	\N
129	121	\N	\N	up	257	258	\N
130	121	\N	\N	datosAuditoria	259	260	\N
131	121	\N	\N	setInitSessionConditions	261	262	\N
184	176	\N	\N	getDia	367	368	\N
132	121	\N	\N	setSessionConditions	263	264	\N
133	121	\N	\N	getSessionConditions	265	266	\N
134	121	\N	\N	getDia	267	268	\N
135	121	\N	\N	getMes	269	270	\N
176	1	\N	\N	Wordollartypechanges	352	371	\N
164	162	\N	\N	addEdit	327	328	\N
185	176	\N	\N	getMes	369	370	\N
138	136	\N	\N	view	275	276	\N
165	162	\N	\N	view	329	330	\N
139	136	\N	\N	add	277	278	\N
201	197	\N	\N	setSessionConditions	401	402	\N
140	136	\N	\N	edit	279	280	\N
166	162	\N	\N	delete	331	332	\N
141	136	\N	\N	delete	281	282	\N
142	136	\N	\N	fletesucursales	283	284	\N
167	162	\N	\N	setActive	333	334	\N
143	136	\N	\N	asignarfletes	285	286	\N
212	205	\N	\N	getPdf	423	424	\N
144	136	\N	\N	datosAuditoria	287	288	\N
168	162	\N	\N	getClients	335	336	\N
145	136	\N	\N	setInitSessionConditions	289	290	\N
146	136	\N	\N	setSessionConditions	291	292	\N
169	162	\N	\N	setClient	337	338	\N
147	136	\N	\N	getSessionConditions	293	294	\N
202	197	\N	\N	getSessionConditions	403	404	\N
188	186	\N	\N	setEntryOc	375	376	\N
148	136	\N	\N	getDia	295	296	\N
170	162	\N	\N	datosAuditoria	339	340	\N
136	1	\N	\N	Secprojects	272	299	\N
149	136	\N	\N	getMes	297	298	\N
171	162	\N	\N	setInitSessionConditions	341	342	\N
151	150	\N	\N	index	301	302	\N
226	219	\N	\N	setInitSessionConditions	451	452	\N
152	150	\N	\N	view	303	304	\N
189	186	\N	\N	view	377	378	\N
172	162	\N	\N	setSessionConditions	343	344	\N
153	150	\N	\N	add	305	306	\N
154	150	\N	\N	edit	307	308	\N
173	162	\N	\N	getSessionConditions	345	346	\N
155	150	\N	\N	delete	309	310	\N
203	197	\N	\N	getDia	405	406	\N
156	150	\N	\N	datosAuditoria	311	312	\N
190	186	\N	\N	getPdf	379	380	\N
174	162	\N	\N	getDia	347	348	\N
157	150	\N	\N	setInitSessionConditions	313	314	\N
158	150	\N	\N	setSessionConditions	315	316	\N
162	1	\N	\N	Worclients	324	351	\N
175	162	\N	\N	getMes	349	350	\N
159	150	\N	\N	getSessionConditions	317	318	\N
160	150	\N	\N	getDia	319	320	\N
213	205	\N	\N	datosAuditoria	425	426	\N
150	1	\N	\N	Secroles	300	323	\N
191	186	\N	\N	datosAuditoria	381	382	\N
197	1	\N	\N	Worestimatedetails	394	409	\N
204	197	\N	\N	getMes	407	408	\N
192	186	\N	\N	setInitSessionConditions	383	384	\N
178	176	\N	\N	addEdit	355	356	\N
179	176	\N	\N	view	357	358	\N
193	186	\N	\N	setSessionConditions	385	386	\N
180	176	\N	\N	datosAuditoria	359	360	\N
221	219	\N	\N	addEdit	441	442	\N
181	176	\N	\N	setInitSessionConditions	361	362	\N
194	186	\N	\N	getSessionConditions	387	388	\N
182	176	\N	\N	setSessionConditions	363	364	\N
214	205	\N	\N	setInitSessionConditions	427	428	\N
183	176	\N	\N	getSessionConditions	365	366	\N
195	186	\N	\N	getDia	389	390	\N
186	1	\N	\N	Worentrynotes	372	393	\N
196	186	\N	\N	getMes	391	392	\N
207	205	\N	\N	indexExel	413	414	\N
234	232	\N	\N	indexExel	467	468	\N
198	197	\N	\N	getEstimatedetailsTipe	395	396	\N
215	205	\N	\N	setSessionConditions	429	430	\N
208	205	\N	\N	setEstimate	415	416	\N
199	197	\N	\N	datosAuditoria	397	398	\N
222	219	\N	\N	view	443	444	\N
216	205	\N	\N	getSessionConditions	431	432	\N
209	205	\N	\N	view	417	418	\N
227	219	\N	\N	setSessionConditions	453	454	\N
210	205	\N	\N	setCerrar	419	420	\N
223	219	\N	\N	delete	445	446	\N
211	205	\N	\N	setAprobar	421	422	\N
217	205	\N	\N	getDia	433	434	\N
231	1	\N	\N	Worinvoicedetails	462	463	\N
205	1	\N	\N	Worestimates	410	437	\N
218	205	\N	\N	getMes	435	436	\N
224	219	\N	\N	setActive	447	448	\N
228	219	\N	\N	getSessionConditions	455	456	\N
236	232	\N	\N	viewInvoivesOt	471	472	\N
225	219	\N	\N	datosAuditoria	449	450	\N
229	219	\N	\N	getDia	457	458	\N
235	232	\N	\N	setInvoice	469	470	\N
219	1	\N	\N	Worinsurances	438	461	\N
230	219	\N	\N	getMes	459	460	\N
240	232	\N	\N	datosAuditoria	479	480	\N
241	232	\N	\N	setInitSessionConditions	481	482	\N
237	232	\N	\N	view	473	474	\N
238	232	\N	\N	getPdf	475	476	\N
239	232	\N	\N	setCerrar	477	478	\N
242	232	\N	\N	setSessionConditions	483	484	\N
243	232	\N	\N	getSessionConditions	485	486	\N
244	232	\N	\N	getDia	487	488	\N
245	232	\N	\N	getMes	489	490	\N
247	246	\N	\N	getOthers	493	494	\N
232	1	\N	\N	Worinvoices	464	491	\N
248	246	\N	\N	setOther	495	496	\N
249	246	\N	\N	datosAuditoria	497	498	\N
250	246	\N	\N	setInitSessionConditions	499	500	\N
251	246	\N	\N	setSessionConditions	501	502	\N
252	246	\N	\N	getSessionConditions	503	504	\N
246	1	\N	\N	Worothers	492	509	\N
285	278	\N	\N	getPdf	569	570	\N
253	246	\N	\N	getDia	505	506	\N
254	246	\N	\N	getMes	507	508	\N
308	302	\N	\N	getSessionConditions	615	616	\N
286	278	\N	\N	datosAuditoria	571	572	\N
257	255	\N	\N	vOt	513	514	\N
287	278	\N	\N	setInitSessionConditions	573	574	\N
258	255	\N	\N	getPdf	515	516	\N
309	302	\N	\N	getDia	617	618	\N
259	255	\N	\N	setAnular	517	518	\N
288	278	\N	\N	setSessionConditions	575	576	\N
260	255	\N	\N	datosAuditoria	519	520	\N
302	1	\N	\N	Worservices	604	621	\N
261	255	\N	\N	setInitSessionConditions	521	522	\N
289	278	\N	\N	getSessionConditions	577	578	\N
262	255	\N	\N	setSessionConditions	523	524	\N
310	302	\N	\N	getMes	619	620	\N
263	255	\N	\N	getSessionConditions	525	526	\N
163	162	\N	\N	index	325	326	1
137	136	\N	\N	index	273	274	1
177	176	\N	\N	index	353	354	1
187	186	\N	\N	index	373	374	1
220	219	\N	\N	index	439	440	1
256	255	\N	\N	index	511	512	1
290	278	\N	\N	getDia	579	580	\N
264	255	\N	\N	getDia	527	528	\N
337	325	\N	\N	getMes	675	676	\N
255	1	\N	\N	Woroutputtickets	510	531	\N
265	255	\N	\N	getMes	529	530	\N
278	1	\N	\N	Worpurchaseorders	556	583	\N
291	278	\N	\N	getMes	581	582	\N
268	266	\N	\N	addEdit	535	536	\N
269	266	\N	\N	view	537	538	\N
270	266	\N	\N	delete	539	540	\N
271	266	\N	\N	setActive	541	542	\N
294	292	\N	\N	addEdit	587	588	\N
272	266	\N	\N	datosAuditoria	543	544	\N
273	266	\N	\N	setInitSessionConditions	545	546	\N
295	292	\N	\N	view	589	590	\N
274	266	\N	\N	setSessionConditions	547	548	\N
313	311	\N	\N	addEdit	625	626	\N
275	266	\N	\N	getSessionConditions	549	550	\N
296	292	\N	\N	datosAuditoria	591	592	\N
276	266	\N	\N	getDia	551	552	\N
266	1	\N	\N	Worpaymenttipes	532	555	\N
277	266	\N	\N	getMes	553	554	\N
297	292	\N	\N	setInitSessionConditions	593	594	\N
314	311	\N	\N	view	627	628	\N
298	292	\N	\N	setSessionConditions	595	596	\N
280	278	\N	\N	indexExel	559	560	\N
281	278	\N	\N	setPurchaseorder	561	562	\N
299	292	\N	\N	getSessionConditions	597	598	\N
282	278	\N	\N	view	563	564	\N
315	311	\N	\N	delete	629	630	\N
283	278	\N	\N	setAprobar	565	566	\N
300	292	\N	\N	getDia	599	600	\N
284	278	\N	\N	setCerrar	567	568	\N
316	311	\N	\N	setActive	631	632	\N
292	1	\N	\N	Worseries	584	603	\N
301	292	\N	\N	getMes	601	602	\N
317	311	\N	\N	getSpareparts	633	634	\N
303	302	\N	\N	getServices	605	606	\N
304	302	\N	\N	setService	607	608	\N
318	311	\N	\N	setSparepart	635	636	\N
305	302	\N	\N	datosAuditoria	609	610	\N
306	302	\N	\N	setInitSessionConditions	611	612	\N
319	311	\N	\N	datosAuditoria	637	638	\N
307	302	\N	\N	setSessionConditions	613	614	\N
320	311	\N	\N	setInitSessionConditions	639	640	\N
321	311	\N	\N	setSessionConditions	641	642	\N
322	311	\N	\N	getSessionConditions	643	644	\N
323	311	\N	\N	getDia	645	646	\N
324	311	\N	\N	getMes	647	648	\N
233	232	\N	\N	index	465	466	1
312	311	\N	\N	index	623	624	1
206	205	\N	\N	index	411	412	1
267	266	\N	\N	index	533	534	1
279	278	\N	\N	index	557	558	1
293	292	\N	\N	index	585	586	1
352	350	\N	\N	datosAuditoria	705	706	\N
327	325	\N	\N	addEdit	655	656	\N
346	338	\N	\N	setSessionConditions	693	694	\N
328	325	\N	\N	view	657	658	\N
329	325	\N	\N	delete	659	660	\N
356	350	\N	\N	getDia	713	714	\N
330	325	\N	\N	setActive	661	662	\N
311	1	\N	\N	Worspareparts	622	651	\N
325	1	\N	\N	Worsuppliers	652	677	\N
398	311		\N	getStock	649	650	1
340	338	\N	\N	addEdit	681	682	\N
331	325	\N	\N	getSuppliers	663	664	\N
347	338	\N	\N	getSessionConditions	695	696	\N
332	325	\N	\N	datosAuditoria	665	666	\N
341	338	\N	\N	setDelete	683	684	\N
333	325	\N	\N	setInitSessionConditions	667	668	\N
353	350	\N	\N	setInitSessionConditions	707	708	\N
334	325	\N	\N	setSessionConditions	669	670	\N
342	338	\N	\N	setActive	685	686	\N
335	325	\N	\N	getSessionConditions	671	672	\N
348	338	\N	\N	getDia	697	698	\N
336	325	\N	\N	getDia	673	674	\N
362	358	\N	\N	delete	725	726	\N
338	1	\N	\N	Wortaxations	678	701	\N
343	338	\N	\N	view	687	688	\N
349	338	\N	\N	getMes	699	700	\N
344	338	\N	\N	datosAuditoria	689	690	\N
350	1	\N	\N	Worubigeos	702	717	\N
354	350	\N	\N	setSessionConditions	709	710	\N
345	338	\N	\N	setInitSessionConditions	691	692	\N
357	350	\N	\N	getMes	715	716	\N
355	350	\N	\N	getSessionConditions	711	712	\N
351	350	\N	\N	getUbigeos	703	704	\N
360	358	\N	\N	addEdit	721	722	\N
366	358	\N	\N	setInitSessionConditions	733	734	\N
363	358	\N	\N	getVehicles	727	728	\N
361	358	\N	\N	view	723	724	\N
367	358	\N	\N	setSessionConditions	735	736	\N
364	358	\N	\N	setVehicle	729	730	\N
365	358	\N	\N	datosAuditoria	731	732	\N
368	358	\N	\N	getSessionConditions	737	738	\N
369	358	\N	\N	getDia	739	740	\N
370	358	\N	\N	getMes	741	742	\N
358	1	\N	\N	Worvehicles	718	743	\N
373	371	\N	\N	indexExel	747	748	\N
374	371	\N	\N	add	749	750	\N
375	371	\N	\N	edit	751	752	\N
376	371	\N	\N	view	753	754	\N
377	371	\N	\N	delete	755	756	\N
378	371	\N	\N	setManoObraTerceros	757	758	\N
379	371	\N	\N	setCerrar	759	760	\N
380	371	\N	\N	setFacturarOt	761	762	\N
381	371	\N	\N	setAprobar	763	764	\N
383	371	\N	\N	getReportExel	767	768	\N
384	371	\N	\N	getSpareparts	769	770	\N
385	371	\N	\N	setSparepart	771	772	\N
386	371	\N	\N	getPdf	773	774	\N
387	371	\N	\N	datosAuditoria	775	776	\N
388	371	\N	\N	setInitSessionConditions	777	778	\N
389	371	\N	\N	setSessionConditions	779	780	\N
390	371	\N	\N	getSessionConditions	781	782	\N
391	371	\N	\N	getDia	783	784	\N
392	371	\N	\N	getMes	785	786	\N
326	325	\N	\N	index	653	654	1
339	338	\N	\N	index	679	680	1
359	358	\N	\N	index	719	720	1
372	371	\N	\N	index	745	746	1
382	371	\N	\N	getReport	765	766	1
371	1	\N	\N	Worworkorders	744	789	\N
394	1		\N	Woroldworkorders	790	793	0
396	394		\N	index	791	792	1
397	395		\N	view	795	796	0
\.


--
-- Name: acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acos_id_seq', 403, true);


--
-- Data for Name: aros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY aros (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
1	\N	Secrole	1	Administrador	1	4
2	1	Secassign	1	admin	2	3
18	4	Secassign	11	agallo	6	7
5	\N	Secrole	4	Administrador de Sucursal	9	14
30	6	Secassign	23	ccarbajal	26	27
8	6	Secassign	4	jpinto	16	17
9	6	Secassign	5	mmedina	18	19
10	6	Secassign	6	jcubas	20	21
11	6	Secassign	7	curiarte	22	23
31	6	Secassign	24	ctorres	28	29
33	6	Secassign	26	jfernandez	32	33
29	6	Secassign	22	ebolanos	24	25
32	6	Secassign	25	hrios	30	31
34	6	Secassign	27	mtejada	34	35
4	\N	Secrole	3	Administrador Gallo Autos	5	8
7	5	Secassign	3	agallo	10	11
25	5	Secassign	18	alfredogallo	12	13
15	12	Secassign	8	jcubas	42	43
21	12	Secassign	14	ebolanos	44	45
22	12	Secassign	15	ccarbajal	46	47
23	12	Secassign	16	ctorres	48	49
12	\N	Secrole	6	Asesor de Servicios	41	52
16	13	Secassign	9	mtejada	54	55
17	14	Secassign	10	curiarte	64	65
19	14	Secassign	12	lgiraldo	66	67
14	\N	Secrole	8	Almacén I	63	70
20	14	Secassign	13	ctamani	68	69
24	12	Secassign	17	hrios	50	51
13	\N	Secrole	7	Secretaria	53	62
26	13	Secassign	19	jfernandez	56	57
27	13	Secassign	20	mipanaque	58	59
6	\N	Secrole	5	Recepción	15	40
36	6	Secassign	29	mipanaque	38	39
35	6	Secassign	28	ezuazo	36	37
28	13	Secassign	21	ezuazo	60	61
38	\N	Secrole	10	Administrador S&C	71	74
39	\N	Secrole	11	Administrador de Sucursal	75	78
49	39	Secassign	37	alfredogallo	76	77
50	40	Secassign	38	ebolanos	80	81
51	40	Secassign	39	ccarbajal	82	83
52	40	Secassign	40	hrios	84	85
40	\N	Secrole	12	Asesor de Servicios	79	88
43	41	Secassign	31	mipanaque	90	91
44	41	Secassign	32	jfernandez	92	93
45	41	Secassign	33	hrios	94	95
46	41	Secassign	34	ctorres	96	97
41	\N	Secrole	13	Recepción	89	100
47	41	Secassign	35	ccarbajal	98	99
42	\N	Secrole	14	Secretaria	101	104
48	42	Secassign	36	jfernandez	102	103
53	40	Secassign	41	ctorres	86	87
54	38	Secassign	42	agallo	72	73
\.


--
-- Data for Name: aros_acos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY aros_acos (id, aro_id, aco_id, _create, _read, _update, _delete) FROM stdin;
1	5	162	1	1	1	1
2	5	176	1	1	1	1
3	5	186	1	1	1	1
4	5	197	1	1	1	1
5	5	1	1	1	1	1
6	6	206	1	1	1	1
7	6	205	1	1	1	1
8	6	376	1	1	1	1
9	6	372	1	1	1	1
10	6	373	1	1	1	1
11	6	382	1	1	1	1
12	6	383	1	1	1	1
13	6	386	1	1	1	1
14	4	1	1	1	1	1
15	14	278	1	1	1	1
16	14	186	1	1	1	1
18	14	162	1	1	1	1
19	14	325	1	1	1	1
17	14	255	0	0	0	0
20	14	311	1	1	1	1
21	14	382	1	1	1	1
22	14	383	1	1	1	1
23	1	1	1	1	1	1
24	12	206	1	1	1	1
25	12	207	1	1	1	1
26	12	209	1	1	1	1
28	12	255	1	1	1	1
27	12	371	0	0	0	0
29	12	372	1	1	1	1
30	12	373	1	1	1	1
31	12	374	1	1	1	1
32	12	375	1	1	1	1
33	12	376	1	1	1	1
34	12	377	1	1	1	1
35	12	378	1	1	1	1
36	12	379	1	1	1	1
37	12	381	1	1	1	1
38	12	382	1	1	1	1
39	12	383	1	1	1	1
40	12	384	1	1	1	1
41	12	385	1	1	1	1
42	12	386	1	1	1	1
43	12	387	1	1	1	1
44	12	388	1	1	1	1
45	12	389	1	1	1	1
46	12	390	1	1	1	1
47	12	391	1	1	1	1
48	12	392	1	1	1	1
49	13	163	1	1	1	1
50	13	165	1	1	1	1
51	13	232	1	1	1	1
52	13	382	1	1	1	1
53	13	383	1	1	1	1
54	13	206	1	1	1	1
55	13	372	1	1	1	1
56	13	373	1	1	1	1
57	13	380	1	1	1	1
58	13	376	1	1	1	1
59	13	386	1	1	1	1
60	12	246	1	1	1	1
61	12	302	1	1	1	1
62	12	350	1	1	1	1
63	12	358	1	1	1	1
64	14	350	1	1	1	1
65	12	394	1	1	1	1
66	12	395	1	1	1	1
67	6	394	1	1	1	1
68	6	395	1	1	1	1
69	13	394	1	1	1	1
70	13	395	1	1	1	1
71	6	162	1	1	1	1
72	12	162	1	1	1	1
74	13	400	1	1	1	1
76	13	1	1	1	1	1
77	6	1	1	1	1	1
79	12	1	1	1	1	1
\.


--
-- Name: aros_acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('aros_acos_id_seq', 80, true);


--
-- Name: aros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('aros_id_seq', 55, true);


--
-- Data for Name: basicstatus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY basicstatus (id, shortname, name) FROM stdin;
1	AC	Activo
2	DE	Desactivo
3	EL	Eliminado
\.


--
-- Name: basicstatus_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('basicstatus_id_seq', 4, true);


--
-- Data for Name: secassigns; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secassigns (id, secrole_id, secproject_id, secperson_id, status, fixticio) FROM stdin;
1	1	1	1	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
3	4	3	4	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
4	5	3	5	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
5	5	3	6	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
6	5	3	8	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
7	5	3	7	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
8	6	3	8	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
9	7	3	9	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
10	8	3	7	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
11	3	3	4	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
12	8	4	11	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
13	8	4	10	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
14	6	4	12	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
15	6	4	13	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
16	6	4	14	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
17	6	4	15	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
18	4	4	16	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
19	7	4	17	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
20	7	4	18	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
22	5	4	12	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
23	5	4	13	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
24	5	4	14	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
25	5	4	15	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
26	5	4	17	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
27	5	3	9	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
29	5	4	18	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
28	5	4	19	DE	984413ed80913491eb3a1b7fb06bb8cf453dff72
21	7	4	19	DE	984413ed80913491eb3a1b7fb06bb8cf453dff72
31	13	6	18	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
32	13	6	17	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
33	13	6	15	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
34	13	6	14	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
35	13	6	13	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
36	14	6	17	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
37	11	6	16	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
38	12	6	12	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
39	12	6	13	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
40	12	6	15	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
41	12	6	14	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
42	10	6	4	AC	984413ed80913491eb3a1b7fb06bb8cf453dff72
\.


--
-- Name: secassigns_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secassigns_id_seq', 43, true);


--
-- Data for Name: secconfigurations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secconfigurations (id, minpasswordlength, passwordtimelife, previouspasswordlimit) FROM stdin;
\.


--
-- Name: secconfigurations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secconfigurations_id_seq', 1, false);


--
-- Data for Name: secorganizations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secorganizations (id, code, name, type, theme, texto, address, ruc, photo1, photo2, phone, status, view_boleta, view_factura, directoriofirma, view_recibo) FROM stdin;
1	00001	TALLER	\N	0	verde	Jr Hermilio Valdizan 123	12345678901	taller_01.bmp	cropped-banner-verde.jpg	5555333	AC	get_pdf_boleta	get_pdf_factura		get_pdf_recibo
3	GA	GALLO AUTOS	0	THEMA		Av. Javier Prado Este 3536 - San Borja	10258625761	galloautos.bmp	galloautos.bmp		AC	get_pdf_boleta	get_pdf_factura	\N	get_pdf_recibo
5	SC	S&C AUTOS SAC	0	THEMA		AV. LA MOLINA 678   LA MOLINA - LIMA - PERU	20600246080	galloautos.bmp	galloautos.bmp		AC	get_pdf_boleta	get_pdf_factura	\N	get_pdf_recibo
\.


--
-- Name: secorganizations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secorganizations_id_seq', 6, true);


--
-- Data for Name: secpasswords; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secpasswords (id, secperson_id, password, creationdatetime, status) FROM stdin;
1	1	81dc9bdb52d04dc20036dbd8313ed055	2013-01-01	AC
3	1	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	DE
4	1	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	DE
5	4	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	DE
6	4	06501be2f838d48bd9da03acf46445f9fa010bfa	\N	DE
\.


--
-- Name: secpasswords_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secpasswords_id_seq', 7, true);


--
-- Data for Name: secpeople; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secpeople (id, firstname, appaterno, apmaterno, privelege, username, email, status, creationdate, expirationdate, password, address, language, archivofisico, archivo) FROM stdin;
5	Jorge	Pinto	.	0	jpinto		AC	2013-05-30	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
6	Marcial	Medina	.	0	mmedina		AC	2013-05-30	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
7	Cesar	Uriarte	.	0	curiarte		AC	2013-05-30	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
8	Juan	Cubas	.	0	jcubas		AC	2013-05-30	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
9	Milagros	Tejada	.	0	mtejada		AC	2013-05-30	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
10	CARLOS	TAMANI	.	0	ctamani		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
11	LUIS	GIRALDO	.	0	lgiraldo		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
12	EDUARDO	BOLAÑOS	.	0	ebolanos		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
13	CHRISTIAN	CARBAJAL	.	0	ccarbajal		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
14	CHRISTIAN	TORRES	.	0	ctorres		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
15	HAROLD	RIOS	.	0	hrios		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
16	ALFREDO	GALLO	.	0	alfredogallo		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
17	JESSY	FERNANDEZ	.	0	jfernandez		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
18	MERCEDES	IPANAQUE	.	0	mipanaque		AC	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
19	ESTEFANíA	ZUAZO	.	0	ezuazo		DE	2013-06-13	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
3	Jose	ventura	rueda	0	aventura	jose_ventura_07h@hotmail.com	DE	2013-05-30	2013-06-28	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
1	admin	admin	admin	0	admin	cchiu@chiusac.com	AC	2012-08-01	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	\N	\N	\N
4	Alicia	Gallo	Linares	0	agallo		AC	2013-05-30	2013-12-31	08423b9c8b450fb260c6bbc7af96da35c54cf145	\N	spa	\N	\N
\.


--
-- Name: secpeople_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secpeople_id_seq', 20, true);


--
-- Data for Name: secprograms; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secprograms (id, aro_id, aco_id, parent_id, lft, rght, etiqueta) FROM stdin;
1	5	163	2	2	3	Clientes
3	5	326	2	4	5	Proveedores
4	5	312	2	6	7	Repuestos
18	5	\N	\N	39	42	Presupuesto
25	5	372	18	40	41	Presupuesto
13	5	293	2	12	13	Series y nro. Documento
19	5	\N	\N	43	46	Facturas, Boletas y Recibos
26	5	233	19	44	45	Facturas, Boletas y Recibos
20	5	\N	\N	47	50	Notas de Ingreso
14	5	267	2	14	15	Formas de Pago
27	5	187	20	48	49	Notas de Ingreso
21	5	\N	\N	51	54	Vales de Salida
28	5	256	21	52	53	Vales de Salida
2	5	\N	\N	1	18	Tablas Básicas
6	1	\N	\N	19	22	Seguridad
7	1	\N	\N	23	26	Acciones
11	5	177	2	8	9	Tipo de cambio de dólares
5	1	14	7	24	25	Acciones
8	1	78	6	20	21	Seguridad
10	1	\N	\N	27	30	Gestión de Menús y Permios
9	1	26	10	28	29	Gestión de Menús y Permios
15	5	339	2	16	17	IGV
29	5	382	22	56	57	Reporte de Ots
12	5	220	2	10	11	Aseguradoras
16	5	\N	\N	31	34	Orden de Compra
23	5	279	16	32	33	Orden de Compra
17	5	\N	\N	35	38	Orden de Trabajo
24	5	206	17	36	37	Orden de Trabajo
73	12	\N	\N	143	146	Clientes
71	6	\N	\N	147	150	Clientes
52	12	\N	\N	111	114	Orden de Trabajo
53	12	206	52	112	113	Orden de Trabajo
55	12	382	54	124	125	Reporte de Ots
54	12	\N	\N	123	128	Reporte
66	5	396	22	58	59	Ordenes Antiguas
69	12	396	54	126	127	Ordenes Antiguas
50	14	\N	\N	105	110	Reporte
76	14	398	50	108	109	Consulta de stock de Repuestos
49	14	\N	\N	97	100	Proveedores
48	14	326	49	98	99	Proveedores
46	14	\N	\N	101	104	Orden de Compra
47	14	279	46	102	103	Orden de Compra
51	14	382	50	106	107	Reporte de Ots
36	4	\N	\N	77	80	Seguridad
39	4	78	36	78	79	Seguridad
37	4	\N	\N	81	84	Acciones
34	6	\N	\N	71	76	Reporte
31	6	\N	\N	63	66	Orden de Trabajo
32	6	\N	\N	67	70	Presupuesto
33	6	372	32	68	69	Presupuesto
30	6	206	31	64	65	Orden de Trabajo
35	6	382	34	72	73	Reporte de Ots
22	5	\N	\N	55	62	Reporte
75	5	398	22	60	61	Consulta de stock de Repuestos
60	13	\N	\N	129	132	Presupuesto
61	13	372	60	130	131	Presupuesto
62	13	\N	\N	133	136	Facturas, Boletas y Recibos
63	13	233	62	134	135	Facturas, Boletas y Recibos
65	13	382	64	138	139	Reporte de Ots
64	13	\N	\N	137	142	Reporte
68	13	396	64	140	141	Ordenes Antiguas
74	12	163	73	144	145	Clientes
72	6	163	71	148	149	Clientes
58	13	\N	\N	115	118	Clientes
59	13	163	58	116	117	Clientes
56	12	\N	\N	119	122	Presupuesto
57	12	372	56	120	121	Presupuesto
38	4	\N	\N	85	88	Gestión de Menús y Permios
41	4	26	38	86	87	Gestión de Menús y Permios
42	14	\N	\N	89	92	Clientes
43	14	163	42	90	91	Clientes
44	14	\N	\N	93	96	Repuestos
45	14	312	44	94	95	Repuestos
67	6	396	34	74	75	Ordenes Antiguas
78	5	\N	\N	151	154	Proceso
79	5	400	78	152	153	Correr Script
80	13	\N	\N	155	158	Proceso
81	13	400	80	156	157	Correr Script
40	4	14	37	82	83	Acciones
98	39	163	83	160	161	Clientes
99	39	326	83	162	163	Proveedores
100	39	312	83	164	165	Repuestos
101	39	177	83	166	167	Tipo de cambio de dólares
102	39	220	83	168	169	Aseguradoras
103	39	293	83	170	171	Series y nro. Documento
104	39	267	83	172	173	Formas de Pago
83	39	\N	\N	159	176	Tablas Básicas
105	39	339	83	174	175	IGV
84	39	\N	\N	177	180	Orden de Compra
85	39	\N	\N	181	184	Orden de Trabajo
106	39	206	85	182	183	Orden de Trabajo
107	39	279	84	178	179	Orden de Compra
86	39	\N	\N	185	188	Presupuesto
108	39	372	86	186	187	Presupuesto
87	39	\N	\N	189	192	Facturas, Boletas y Recibos
109	39	233	87	190	191	Facturas/Boleta/Recibo
88	39	\N	\N	193	196	Notas de Ingreso
110	39	187	88	194	195	Notas de Ingreso
89	39	\N	\N	197	200	Vales de Salida
111	39	256	89	198	199	Vales de Salida
112	39	382	90	202	203	Reporte de Ots
90	39	\N	\N	201	206	Reporte
91	39	\N	\N	207	210	Proceso
92	38	\N	\N	211	214	Seguridad
95	38	78	92	212	213	Seguridad
93	38	\N	\N	215	218	Acciones
96	38	14	93	216	217	Acciones
94	38	\N	\N	219	222	Gestión de Menús y Permisos
97	38	26	94	220	221	Gestión de Menús y Permisos
113	39	400	91	208	209	Correr Script
114	40	\N	\N	223	226	Orden de Trabajo
118	40	206	114	224	225	Orden de Trabajo
115	40	\N	\N	227	230	Presupuesto
119	40	372	115	228	229	Presupuesto
120	40	382	116	232	233	Reporte de Ots
140	39	396	90	204	205	Reporte Ots Antiguas
116	40	\N	\N	231	236	Reporte
117	40	\N	\N	237	240	Clientes
121	40	163	117	238	239	Clientes
122	41	\N	\N	241	244	Orden de Trabajo
126	41	206	122	242	243	Orden de Trabajo
123	41	\N	\N	245	248	Presupuesto
127	41	372	123	246	247	Presupuesto
128	41	382	124	250	251	Reporte de Ots
124	41	\N	\N	249	254	Reporte
125	41	\N	\N	255	258	Clientes
129	41	163	125	256	257	Clientes
130	42	\N	\N	259	262	Clientes
131	42	163	130	260	261	Clientes
132	42	\N	\N	263	266	Presupuesto
133	42	372	132	264	265	Presupuesto
134	42	\N	\N	267	270	Facturas/Boleta/Recibo
135	42	233	134	268	269	Facturas/Boleta/Recibo
137	42	382	136	272	273	Reporte de Ots
136	42	\N	\N	271	276	Reporte
138	42	\N	\N	277	280	Proceso
139	42	400	138	278	279	Correr Script
141	42	396	136	274	275	Reporte Ots Antiguas
142	41	396	124	252	253	Reporte Ots Antiguas
143	40	396	116	234	235	Reporte Ots Antiguas
\.


--
-- Name: secprograms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secprograms_id_seq', 144, true);


--
-- Data for Name: secprojects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secprojects (id, secorganization_id, code, name, photo1, text1, status, direccion, telefono) FROM stdin;
1	1	001	Huanuco	\N	Jr. Hermilio Valdizan Nro	AC	\N	\N
4	3	LM	LA MOLINA			AC	Av. la Molina N° 678 Urb. Residencial Monterrico	437-7641
3	3	JP	JAVIER PRADO			AC	Av. Javier Prado Este N° 3536 - San Borja	436-6641
6	5	LMSC	LA MOLINA			AC		
\.


--
-- Name: secprojects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secprojects_id_seq', 7, true);


--
-- Data for Name: secroles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY secroles (id, secorganization_id, code, name, status) FROM stdin;
1	1	admin	Administrador	AC
3	3	ADM	Administrador Gallo Autos	AC
4	3	ADMS	Administrador de Sucursal	AC
5	3	RECEP	Recepción	AC
6	3	ASS	Asesor de Servicios	AC
7	3	SEC	Secretaria	AC
8	3	ALMI	Almacén I	AC
10	5	ADMSC	Administrador S&C	AC
11	5	ADSC	Administrador de Sucursal	AC
12	5	ASC	Asesor de Servicios	AC
13	5	RSC	Recepción	AC
14	5	SSC	Secretaria	AC
\.


--
-- Name: secroles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secroles_id_seq', 15, true);


--
-- Name: acos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acos
    ADD CONSTRAINT acos_pkey PRIMARY KEY (id);


--
-- Name: aros_acos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY aros_acos
    ADD CONSTRAINT aros_acos_pkey PRIMARY KEY (id);


--
-- Name: aros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY aros
    ADD CONSTRAINT aros_pkey PRIMARY KEY (id);


--
-- Name: basicstatus_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY basicstatus
    ADD CONSTRAINT basicstatus_pkey PRIMARY KEY (id);


--
-- Name: secassigns_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY secassigns
    ADD CONSTRAINT secassigns_pkey PRIMARY KEY (id);


--
-- Name: secorganizations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY secorganizations
    ADD CONSTRAINT secorganizations_pkey PRIMARY KEY (id);


--
-- Name: secpasswords_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY secpasswords
    ADD CONSTRAINT secpasswords_pkey PRIMARY KEY (id);


--
-- Name: secpeople_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY secpeople
    ADD CONSTRAINT secpeople_pkey PRIMARY KEY (id);


--
-- Name: secprograms_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY secprograms
    ADD CONSTRAINT secprograms_pkey PRIMARY KEY (id);


--
-- Name: secprojects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY secprojects
    ADD CONSTRAINT secprojects_pkey PRIMARY KEY (id);


--
-- Name: secroles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY secroles
    ADD CONSTRAINT secroles_pkey PRIMARY KEY (id);


--
-- Name: secassigns_secproject_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY secassigns
    ADD CONSTRAINT secassigns_secproject_id_fkey FOREIGN KEY (secproject_id) REFERENCES secprojects(id);


--
-- Name: secassigns_secrole_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY secassigns
    ADD CONSTRAINT secassigns_secrole_id_fkey FOREIGN KEY (secrole_id) REFERENCES secroles(id);


--
-- Name: secpasswords_secperson_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY secpasswords
    ADD CONSTRAINT secpasswords_secperson_id_fkey FOREIGN KEY (secperson_id) REFERENCES secpeople(id);


--
-- Name: secprojects_secorganization_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY secprojects
    ADD CONSTRAINT secprojects_secorganization_id_fkey FOREIGN KEY (secorganization_id) REFERENCES secorganizations(id);


--
-- Name: secroles_secorganization_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY secroles
    ADD CONSTRAINT secroles_secorganization_id_fkey FOREIGN KEY (secorganization_id) REFERENCES secorganizations(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

