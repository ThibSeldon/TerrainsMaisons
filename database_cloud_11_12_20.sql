--
-- PostgreSQL database dump
--

-- Dumped from database version 11.9 (Debian 11.9-1.pgdg90+1)
-- Dumped by pg_dump version 13.0 (Debian 13.0-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY public.plot DROP CONSTRAINT fk_bebb8f895d83cc1;
ALTER TABLE ONLY public.plot DROP CONSTRAINT fk_bebb8f891bf0861f;
ALTER TABLE ONLY public.allotment_contact DROP CONSTRAINT fk_ac17dbdfe7a1254a;
ALTER TABLE ONLY public.allotment_contact DROP CONSTRAINT fk_ac17dbdf1bf0861f;
ALTER TABLE ONLY public.house DROP CONSTRAINT fk_67d5399dd95fdb2b;
ALTER TABLE ONLY public.house DROP CONSTRAINT fk_67d5399d27676b57;
ALTER TABLE ONLY public.house DROP CONSTRAINT fk_67d5399d24d9b445;
ALTER TABLE ONLY public.house DROP CONSTRAINT fk_67d5399d1ae70cb8;
ALTER TABLE ONLY public.contact DROP CONSTRAINT fk_4c62e638e6389d24;
ALTER TABLE ONLY public.allotment_house_roofing DROP CONSTRAINT fk_469cf8d324d9b445;
ALTER TABLE ONLY public.allotment_house_roofing DROP CONSTRAINT fk_469cf8d31bf0861f;
ALTER TABLE ONLY public.picture DROP CONSTRAINT fk_16db4f896bb74515;
DROP INDEX public.uniq_8d93d649e7927c74;
DROP INDEX public.uniq_67d5399d5e237e06;
DROP INDEX public.idx_bebb8f895d83cc1;
DROP INDEX public.idx_bebb8f891bf0861f;
DROP INDEX public.idx_ac17dbdfe7a1254a;
DROP INDEX public.idx_ac17dbdf1bf0861f;
DROP INDEX public.idx_67d5399dd95fdb2b;
DROP INDEX public.idx_67d5399d27676b57;
DROP INDEX public.idx_67d5399d24d9b445;
DROP INDEX public.idx_67d5399d1ae70cb8;
DROP INDEX public.idx_4c62e638e6389d24;
DROP INDEX public.idx_469cf8d324d9b445;
DROP INDEX public.idx_469cf8d31bf0861f;
DROP INDEX public.idx_16db4f896bb74515;
ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
ALTER TABLE ONLY public.state DROP CONSTRAINT state_pkey;
ALTER TABLE ONLY public.society DROP CONSTRAINT society_pkey;
ALTER TABLE ONLY public.plot DROP CONSTRAINT plot_pkey;
ALTER TABLE ONLY public.picture DROP CONSTRAINT picture_pkey;
ALTER TABLE ONLY public.house_style DROP CONSTRAINT house_style_pkey;
ALTER TABLE ONLY public.house_roofing DROP CONSTRAINT house_roofing_pkey;
ALTER TABLE ONLY public.house DROP CONSTRAINT house_pkey;
ALTER TABLE ONLY public.house_model DROP CONSTRAINT house_model_pkey;
ALTER TABLE ONLY public.house_brand DROP CONSTRAINT house_brand_pkey;
ALTER TABLE ONLY public.doctrine_migration_versions DROP CONSTRAINT doctrine_migration_versions_pkey;
ALTER TABLE ONLY public.contact DROP CONSTRAINT contact_pkey;
ALTER TABLE ONLY public.allotment DROP CONSTRAINT allotment_pkey;
ALTER TABLE ONLY public.allotment_house_roofing DROP CONSTRAINT allotment_house_roofing_pkey;
ALTER TABLE ONLY public.allotment_contact DROP CONSTRAINT allotment_contact_pkey;
DROP SEQUENCE public.user_id_seq;
DROP TABLE public."user";
DROP SEQUENCE public.state_id_seq;
DROP TABLE public.state;
DROP SEQUENCE public.society_id_seq;
DROP TABLE public.society;
DROP SEQUENCE public.plot_id_seq;
DROP TABLE public.plot;
DROP SEQUENCE public.picture_id_seq;
DROP TABLE public.picture;
DROP SEQUENCE public.house_style_id_seq;
DROP TABLE public.house_style;
DROP SEQUENCE public.house_roofing_id_seq;
DROP TABLE public.house_roofing;
DROP SEQUENCE public.house_model_id_seq;
DROP TABLE public.house_model;
DROP SEQUENCE public.house_id_seq;
DROP SEQUENCE public.house_brand_id_seq;
DROP TABLE public.house_brand;
DROP TABLE public.house;
DROP TABLE public.doctrine_migration_versions;
DROP SEQUENCE public.contact_id_seq;
DROP TABLE public.contact;
DROP SEQUENCE public.allotment_id_seq;
DROP TABLE public.allotment_house_roofing;
DROP TABLE public.allotment_contact;
DROP TABLE public.allotment;
SET default_tablespace = '';

--
-- Name: allotment; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.allotment (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    postal_code integer NOT NULL,
    city character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone,
    property_limit double precision,
    double_limit boolean NOT NULL
);


--
-- Name: allotment_contact; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.allotment_contact (
    allotment_id integer NOT NULL,
    contact_id integer NOT NULL
);


--
-- Name: allotment_house_roofing; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.allotment_house_roofing (
    allotment_id integer NOT NULL,
    house_roofing_id integer NOT NULL
);


--
-- Name: allotment_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.allotment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: contact; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.contact (
    id integer NOT NULL,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying,
    email character varying(255) DEFAULT NULL::character varying,
    phone_number character varying(255) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updtated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    note text,
    society_id integer
);


--
-- Name: contact_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.contact_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


--
-- Name: house; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.house (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    living_space double precision NOT NULL,
    annex_surface double precision,
    room_number integer NOT NULL,
    bathroom_number integer NOT NULL,
    selling_price_df double precision NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    length double precision,
    width double precision,
    height double precision,
    house_roofing_id integer,
    house_brand_id integer,
    house_model_id integer,
    selling_price_ati double precision,
    valid boolean NOT NULL,
    plan_filename character varying(255) DEFAULT NULL::character varying,
    house_style_id integer
);


--
-- Name: house_brand; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.house_brand (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


--
-- Name: house_brand_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.house_brand_id_seq
    START WITH 4
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: house_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.house_id_seq
    START WITH 107
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: house_model; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.house_model (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


--
-- Name: house_model_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.house_model_id_seq
    START WITH 4
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: house_roofing; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.house_roofing (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


--
-- Name: house_roofing_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.house_roofing_id_seq
    START WITH 4
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: house_style; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.house_style (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


--
-- Name: house_style_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.house_style_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: picture; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.picture (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    house_id integer
);


--
-- Name: picture_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.picture_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: plot; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.plot (
    id integer NOT NULL,
    allotment_id integer NOT NULL,
    lot character varying(255) NOT NULL,
    surface double precision NOT NULL,
    facade_width double precision,
    selling_price_ati double precision NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone,
    state_id integer
);


--
-- Name: plot_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.plot_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: society; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.society (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone_number character varying(255) DEFAULT NULL::character varying
);


--
-- Name: society_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.society_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: state; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.state (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


--
-- Name: state_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.state_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: user; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying
);


--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Data for Name: allotment; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.allotment (id, name, postal_code, city, created_at, updated_at, property_limit, double_limit) FROM stdin;
13	Zone Chanzy Forgeot	51100	Châlons-en-Champagne	2020-12-04 15:06:43	\N	\N	t
14	Les Bermonts	51150	Ambonnay	2020-12-04 15:27:19	\N	\N	t
15	Les Houettes	51220	Cauroy les Hermonville	2020-12-04 15:36:34	\N	\N	t
18	Sollepretre	51220	Hermonville	2020-12-04 16:22:44	\N	0	t
19	Caurel	51110	Caurel	2020-12-04 16:29:31	\N	0	t
1	La Côte des Blancs	8	Juniville	2020-11-27 17:41:29	2020-12-05 17:37:13	0	t
17	Les Closeaux	51110	Aumenancourt	2020-12-04 16:21:29	2020-12-07 21:17:06	0	t
16	Le Jardin des Vignes 3	51525	Sarry	2020-12-04 15:46:12	2020-12-08 17:57:47	0	t
2	Le Bois Montépillois	51350	Cormontreuil	2020-11-29 15:47:35	2020-12-11 12:33:46	4	t
20	Chigny-les-Roses	51500	Chigny-les-Roses	2020-12-04 16:34:33	2020-12-11 12:34:27	3	t
\.


--
-- Data for Name: allotment_contact; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.allotment_contact (allotment_id, contact_id) FROM stdin;
14	7
15	7
16	7
2	1
17	7
18	7
\.


--
-- Data for Name: allotment_house_roofing; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.allotment_house_roofing (allotment_id, house_roofing_id) FROM stdin;
2	1
2	2
2	3
20	1
\.


--
-- Data for Name: contact; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.contact (id, first_name, last_name, email, phone_number, created_at, updtated_at, note, society_id) FROM stdin;
1	Thibaud	Berdin	contact@groupeberdin.com	0326080404	2020-12-02 21:40:51	2020-12-02 21:41:32	Sympa	2
2	Anne-Laure	PINTAUX	anne-laure.pintaux.51066@notaires.fr	03.26.03.49.72 / 06.46.34.55.69	2020-12-04 14:17:18	\N	\N	3
3	Thierry	DRU	tdru@erlon-immobilier.com	06.07.45.80.50	2020-12-04 14:33:45	\N	\N	4
4	Stéphanie	Boisselet	sb@brooks-immobilier.fr	\N	2020-12-04 14:36:58	\N	A déjà envoyé des plans pour Courcy	5
5	Antoine	Sageste	lagence.as@orange.fr	03 26 86 67 29	2020-12-04 14:43:58	\N	A déjà envoyé un terrain à Cormicy	6
6	Jean-Pierre	Thiebaut	reimsfoch@orpi.com	03.26.06.51.51	2020-12-04 14:46:31	\N	A déjà envoyé des terrains à Pierre-Jean	7
7	Catherine	MOREIGNEAUX	catherine.moreigneaux@ca-nord-est.fr	+33.3.26.35.11.89	2020-12-04 14:49:41	\N	\N	1
8	Coralie	BAFFERT	negociation.08021@notaires.fr	03.24.72.95.59	2020-12-04 14:52:22	\N	Notaire Asfeld	9
9	Vincent	Perrin	vincent.perrin@sacclo.fr	+33 6 63 23 50 75	2020-12-04 14:56:53	\N	A déjà envoyé un terrain Cormontreuil à Pierre-Jean	10
10	Alexandre	Lucet	alexandre.lucet@sacclo.fr	+33 3 26 89 84 21	2020-12-04 14:58:14	\N	A déjà envoyé des terrains à Fismes	10
11	Estelle	Barret	estelle.barret.51025@notaires.fr	06.32.01.63.23	2020-12-04 15:03:20	\N	A envoyé des informations sur le lotissement Brugny-Vaudencourt	11
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20201130191406	2020-11-30 20:18:17	15
DoctrineMigrations\\Version20201201202621	2020-12-02 20:33:16	81
DoctrineMigrations\\Version20201202124021	2020-12-02 20:33:17	53
DoctrineMigrations\\Version20201202153707	2020-12-02 20:33:17	77
DoctrineMigrations\\Version20201204092549	2020-12-04 15:45:23	45
DoctrineMigrations\\Version20201204134522	2020-12-04 15:45:23	1
DoctrineMigrations\\Version20201205133300	2020-12-05 15:52:08	28
DoctrineMigrations\\Version20201205141459	2020-12-05 15:52:08	2
DoctrineMigrations\\Version20201206161634	2020-12-06 17:39:05	45
DoctrineMigrations\\Version20201211074945	2020-12-11 12:31:33	66
\.


--
-- Data for Name: house; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.house (id, name, living_space, annex_surface, room_number, bathroom_number, selling_price_df, created_at, updated_at, length, width, height, house_roofing_id, house_brand_id, house_model_id, selling_price_ati, valid, plan_filename, house_style_id) FROM stdin;
107	SMART-ECO-03	84.1899999999999977	14.5	4	1	83333	2020-11-23 12:40:30	2020-11-23 12:43:53	13.75	8.5	\N	4	2	1	99999.6000000000058	t	\N	\N
41	Perfia (Amande3)	90	16	3	1	108943	2020-11-19 16:15:00	2020-11-24 15:20:36	14	9.80000000000000071	\N	1	1	1	130732	t	\N	\N
4	NATIVIE 4 TRADI	122	0	4	2	117160	2020-11-19 16:15:00	2020-11-21 11:12:26	18.8999999999999986	8.19999999999999929	\N	1	2	1	140592	t	\N	\N
6	AMANDE 4 -100	100	22	4	1	108250	2020-11-19 16:15:00	2020-11-21 11:12:26	16	10.3000000000000007	\N	1	2	1	129900	t	\N	\N
8	CITRONNELLE	96	17.75	4	1	103262	2020-11-19 16:15:00	2020-11-21 11:12:26	\N	\N	\N	1	2	2	123914.399999999994	t	\N	\N
9	ACEROLA 4 -88	88	25	4	1	99203	2020-11-19 16:15:00	2020-11-21 11:12:26	15.8499999999999996	8.5	\N	1	2	1	119043.600000000006	t	\N	\N
10	ALBIZIA	132	20.1600000000000001	4	2	141340	2020-11-19 16:15:00	2020-11-21 11:12:26	16.3000000000000007	17.3000000000000007	\N	1	2	2	169608	t	\N	\N
11	REGLISSE 3 Ð 92	92	17	3	1	100000	2020-11-19 16:15:00	2020-11-21 11:12:26	14.6500000000000004	9.09999999999999964	\N	1	2	1	120000	t	\N	\N
14	ACEROLA 3 -80	80	23	3	1	92590	2020-11-19 16:15:00	2020-11-21 11:12:26	15.5199999999999996	8	\N	1	2	1	111108	t	\N	\N
15	Mirantin	133	16	4	2	143666	2020-11-19 16:15:00	2020-11-21 11:12:26	11.75	8	\N	1	1	2	172399.200000000012	t	\N	\N
17	GROSEILLE	107	22.9600000000000009	4	1	122038	2020-11-19 16:15:00	2020-11-21 11:12:26	\N	\N	\N	1	2	1	146445.600000000006	t	\N	\N
19	ACEROLA 2 -74	74	22	2	1	87860	2020-11-19 16:15:00	2020-11-21 11:12:26	14.5199999999999996	8	\N	1	2	1	105432	t	\N	\N
22	NATIBAN 4 Ð 92	92	0	4	1	97308	2020-11-19 16:15:00	2020-11-21 11:12:26	12.9600000000000009	8.25999999999999979	\N	1	3	1	116769.600000000006	t	\N	\N
24	CANNELLE 4 -106	106	53	4	1	140417	2020-11-19 16:15:00	2020-11-21 11:12:26	16	7.70000000000000018	\N	1	2	2	168500.399999999994	t	\N	\N
26	FRAMBOISE	109	20	4	1	127232	2020-11-19 16:15:00	2020-11-21 11:12:26	17.1999999999999993	15.0999999999999996	\N	1	2	1	152678.399999999994	t	\N	\N
27	NATICEA 3 TT- 91	91	50	3	1	124241	2020-11-19 16:15:00	2020-11-21 11:12:26	14.1199999999999992	8.5600000000000005	\N	1	3	1	149089.200000000012	t	\N	\N
30	QUENETTE 3 -79	79	13	3	1	91771	2020-11-19 16:15:00	2020-11-21 11:12:26	6	11.8000000000000007	\N	1	2	2	110125.199999999997	t	\N	\N
32	NATISUN 4	124	20	4	2	144802	2020-11-19 16:15:00	2020-11-21 11:12:26	23.6999999999999993	11.2300000000000004	\N	1	3	1	173762.399999999994	t	\N	\N
36	NATICEA 3 TM- 91	91	50	3	1	127658	2020-11-19 16:15:00	2020-11-21 11:12:26	14.1199999999999992	8.5600000000000005	\N	2	3	1	153189.600000000006	t	\N	\N
37	NATIKAO 4 - 102	102	16	4	1	120698	2020-11-19 16:15:00	2020-11-21 11:12:26	15.7200000000000006	9.16000000000000014	\N	1	3	1	144837.600000000006	t	\N	\N
38	NATIKAO 3 -92	92	18	3	1	110409	2020-11-19 16:15:00	2020-11-21 11:12:26	15.6199999999999992	8.5600000000000005	\N	1	3	1	132490.799999999988	t	\N	\N
39	KIWANO 3 Ð 95	95	16	3	1	113699	2020-11-19 16:15:00	2020-11-21 11:12:26	15.5399999999999991	9.14000000000000057	\N	1	2	2	136438.799999999988	t	\N	\N
43	NATIVIE 4 - 117	118	0	4	1	131121	2020-11-19 16:15:00	2020-11-21 11:12:26	18.5199999999999996	7.95999999999999996	\N	2	3	1	157345.200000000012	t	\N	\N
44	NATIGREEN 5	151	28	5	2	183733	2020-11-19 16:15:00	2020-11-21 11:12:26	15.2899999999999991	13.8000000000000007	\N	1	3	2	220479.600000000006	t	\N	\N
45	ANIS Toiture Tradi 4 - 100	104	17	4	1	125833	2020-11-19 16:15:00	2020-11-21 11:12:26	16	10.3000000000000007	\N	1	2	1	150999.600000000006	t	\N	\N
46	KIWANO 4 Ð 101	101	16	4	1	121948	2020-11-19 16:15:00	2020-11-21 11:12:26	16.3399999999999999	9.14000000000000057	\N	1	2	2	146337.600000000006	t	\N	\N
47	BERGAMOTE 3 Plan Berdin	93	18	3	1	114246	2020-11-19 16:15:00	2020-11-21 11:12:26	9.80000000000000071	8.80000000000000071	\N	1	2	2	137095.200000000012	t	\N	\N
48	NATIRENA 3 Ð 85	85	14	3	1	104128	2020-11-19 16:15:00	2020-11-21 11:12:26	10.3599999999999994	11.5600000000000005	\N	1	3	1	124953.600000000006	t	\N	\N
49	TONKA 3 Ð 90	90	24	3	1	115144	2020-11-19 16:15:00	2020-11-21 11:12:26	9.15000000000000036	10	\N	1	2	2	138172.799999999988	t	\N	\N
51	NATISOON 4 TT- 104	104	20	4	1	129138	2020-11-19 16:15:00	2020-11-21 11:12:26	11.9199999999999999	12.8100000000000005	\N	1	3	1	154965.600000000006	t	\N	\N
52	LAURIER 4+1	125	26	4	2	157042	2020-11-19 16:15:00	2020-11-21 11:12:26	\N	\N	\N	1	2	2	188450.399999999994	t	\N	\N
53	NATIMIX 4 - 117	117	20	4	1	144215	2020-11-19 16:15:00	2020-11-21 11:12:26	15.7599999999999998	15.5999999999999996	\N	1	3	1	173058	t	\N	\N
54	NATILYS 3 Ð 91	91	20	3	1	115044	2020-11-19 16:15:00	2020-11-21 11:12:26	14.7200000000000006	10.2300000000000004	\N	1	3	1	138052.799999999988	t	\N	\N
55	NATIRENA 4 Ð 92	91	14	4	1	112166	2020-11-19 16:15:00	2020-11-21 11:12:26	10.3599999999999994	11.5600000000000005	\N	1	3	1	134599.200000000012	t	\N	\N
56	MANIGUETTE 3 Ð 76	76	15	3	1	95626	2020-11-19 16:15:00	2020-11-21 11:12:26	7.79999999999999982	11.6999999999999993	\N	1	2	2	114751.199999999997	t	\N	\N
57	NATISUN 3	103	21	3	2	129805	2020-11-19 16:15:00	2020-11-21 11:12:26	21.6499999999999986	11.2300000000000004	\N	1	3	1	155766	t	\N	\N
59	NATIVAL 4 - 128	128	17	4	2	156863	2020-11-19 16:15:00	2020-11-21 11:12:27	14.5600000000000005	8.5600000000000005	\N	1	3	3	188235.600000000006	t	\N	\N
60	LAURIER 4	119	26	4	1	153792	2020-11-19 16:15:00	2020-11-21 11:12:27	\N	\N	\N	1	2	2	184550.399999999994	t	\N	\N
63	NATIBAN 3 Ð 75	75	0	3	1	88322	2020-11-19 16:15:00	2020-11-21 11:12:27	11.1600000000000001	7.95999999999999996	\N	1	3	1	105986.399999999994	t	\N	\N
5	CURCUMA 4 Ð 100	100	17	4	1	105000	2020-11-19 16:15:00	2020-11-21 11:12:26	12.1999999999999993	6.79999999999999982	\N	1	2	2	126000	t	\N	\N
13	CARAMBOLE 3 Ð 96	96	50	3	1	122296	2020-11-19 16:15:00	2020-11-21 11:12:26	13.9499999999999993	9	\N	1	2	2	146755.200000000012	t	\N	\N
33	MIKENO	108	34	4	1	135833	2020-11-19 16:15:00	2020-11-24 15:28:52	19.25	10.3000000000000007	\N	1	1	1	163000	t	\N	\N
21	LORENTIDES	115	30	4	1	137250	2020-11-19 16:15:00	2020-11-24 15:50:55	13.75	15.8499999999999996	\N	1	1	1	164700	t	\N	\N
3	CERISE 3 - 89	89	22	3	1	96022	2020-11-19 16:15:00	2020-12-02 21:32:48	17.4299999999999997	10.4499999999999993	\N	1	2	2	115227	t	\N	\N
2	REGLISSE 4 -102	102	16	4	1	104583	2020-11-19 16:15:00	2020-12-02 21:37:15	15	9.59999999999999964	\N	1	2	1	125500	t	REGLISSE-4-5fbfecd8152918.05819225.pdf	\N
16	CURCUMA 3 - 90	90	18	3	1	101667	2020-11-19 16:15:00	2020-12-04 15:52:27	11.8499999999999996	6.59999999999999964	\N	1	2	2	122001	t	\N	\N
23	Meije (Colza 111)	111	16	4	1	126384	2020-11-19 16:15:00	2020-12-08 22:16:48	8.90000000000000036	9.55000000000000071	\N	1	1	2	151661	t	\N	1
40	NATILYS 4 - 103	103	16	4	1	122382	2020-11-19 16:15:00	2020-12-09 16:36:18	15.9199999999999999	10.2300000000000004	\N	1	3	1	146859	t	\N	1
12	CARAMBOLE 4- 105	105	59	4	1	135336	2020-11-19 16:15:00	2020-12-09 16:36:25	15.0500000000000007	9	\N	1	2	2	162404	t	\N	1
25	Denali (Pensée 120)	121	23	4	2	140829	2020-11-19 16:15:00	2020-12-09 21:52:56	13.3499999999999996	8.19999999999999929	\N	1	1	2	168995	t	\N	1
18	REGLISSE 2- 82	82	16	2	1	92991	2020-11-19 16:15:00	2020-12-11 09:27:30	13.3100000000000005	9	\N	1	2	1	111590	t	\N	1
34	CHARMETTE	147	21	4	2	170417	2020-11-19 16:15:00	2020-11-24 15:53:51	15.5	9.94999999999999929	\N	1	1	2	204501	t	\N	\N
31	NATIREY 4 - Aménagée	127	0	4	2	136867	2020-11-19 16:15:00	2020-11-24 18:57:32	10.2100000000000009	9.16000000000000014	\N	1	3	3	164241	t	\N	\N
61	BERGAMOTE 4 - 102	102	20	4	1	130906	2020-11-19 16:15:00	2020-11-24 22:01:02	10.4000000000000004	9	\N	1	2	2	157088	t	\N	\N
29	CAPUCINE 4 - 85	85	15	4	1	99103	2020-11-19 16:15:00	2020-11-26 18:38:41	9	9.19999999999999929	\N	1	2	2	118924	t	\N	\N
7	AMANDE 3 - 89	89	22	3	1	98230	2020-11-19 16:15:00	2020-11-26 19:05:54	14.8000000000000007	9.90000000000000036	\N	1	2	1	117876	t	\N	\N
62	WASABI 3-90	90	15	3	1	114146	2020-11-19 16:15:00	2020-11-27 16:21:58	14.8399999999999999	9.51999999999999957	\N	1	2	2	136976	t	\N	\N
20	NATICEA 4 TT- 108	104	58	4	1	138406	2020-11-19 16:15:00	2020-11-21 11:12:26	14.7200000000000006	9.16000000000000014	\N	1	3	1	166087.200000000012	t	\N	\N
28	NATICEA 4 TM-108	104	58	4	1	142405	2020-11-19 16:15:00	2020-11-21 11:12:26	14.7200000000000006	9.16000000000000014	\N	2	3	1	170886	t	\N	\N
35	NATIVIE 4 TT- 117	118	0	4	1	127572	2020-11-19 16:15:00	2020-11-21 11:12:26	18.5199999999999996	7.95999999999999996	\N	1	3	1	153086.399999999994	t	\N	\N
42	CANNELLE 3 Ð 97	97	39	3	1	129083	2020-11-19 16:15:00	2020-11-21 11:12:26	14.6999999999999993	7.70000000000000018	\N	1	2	2	154899.600000000006	t	\N	\N
50	TONKA 4 Ð 99	99	22	4	1	124431	2020-11-19 16:15:00	2020-11-21 11:12:26	10.1500000000000004	9.80000000000000071	\N	1	2	2	149317.200000000012	t	\N	\N
58	ANIS Toiture Tradi 3 Ð 89	94	17	3	1	117500	2020-11-19 16:15:00	2020-11-21 11:12:26	14.8000000000000007	9.90000000000000036	\N	1	2	1	141000	t	\N	\N
64	NATIVIE 4  - 117	118	0	4	1	137685	2020-11-19 16:15:00	2020-11-21 11:12:27	18.5199999999999996	7.95999999999999996	\N	1	3	1	165222	t	\N	\N
65	NATIMIX 3 - 109	109	20	3	1	139537	2020-11-19 16:15:00	2020-11-21 11:12:27	15.7599999999999998	15.5999999999999996	\N	1	3	1	167444.399999999994	t	\N	\N
66	NATISOON 3 TT - 89	89	20	3	1	117628	2020-11-19 16:15:00	2020-11-21 11:12:27	15.2599999999999998	11.9100000000000001	\N	1	3	1	141153.600000000006	t	\N	\N
67	YUZU 3 Ð 90	90	15	3	1	115274	2020-11-19 16:15:00	2020-11-21 11:12:27	7	14	\N	1	2	2	138328.799999999988	t	\N	\N
68	NATIVIE 3 - 101	101	0	3	2	119569	2020-11-19 16:15:00	2020-11-21 11:12:27	17.3200000000000003	7.36000000000000032	\N	1	3	1	143482.799999999988	t	\N	\N
69	NATILIVE 5 - 129	128	15	5	2	159612	2020-11-19 16:15:00	2020-11-21 11:12:27	10.8000000000000007	10.3599999999999994	\N	1	3	2	191534.399999999994	t	\N	\N
70	YUZU 3 Ð 104	104	18	3	1	133775	2020-11-19 16:15:00	2020-11-21 11:12:27	8	14	\N	1	2	2	160530	t	\N	\N
71	NATISOL 4 - 107	109	21	4	2	141425	2020-11-19 16:15:00	2020-11-21 11:12:27	17.9100000000000001	12.3670000000000009	\N	1	3	1	169710	t	\N	\N
72	TAMARILLO 4 -  115	115	25	4	2	151429	2020-11-19 16:15:00	2020-11-21 11:12:27	12.8399999999999999	20.1479999999999997	\N	1	2	2	181714.799999999988	t	\N	\N
73	NATIMAMBA 4 Ð 101	111	24	4	2	146598	2020-11-19 16:15:00	2020-11-21 11:12:27	18.7199999999999989	10.0600000000000005	\N	3	3	1	175917.600000000006	t	\N	\N
75	TAMARILLO 3 Ð 91	91	18	3	1	119021	2020-11-19 16:15:00	2020-11-21 11:12:27	10.3399999999999999	18.1600000000000001	\N	1	2	2	142825.200000000012	t	\N	\N
76	ANIS Toiture Terrasse 4 Ð 100	104	17	4	1	134167	2020-11-19 16:15:00	2020-11-21 11:12:27	16	10.3000000000000007	\N	3	2	1	161000.399999999994	t	\N	\N
78	NATIVAL 3 TT - 111	111	17	3	1	143696	2020-11-19 16:15:00	2020-11-21 11:12:27	11.5600000000000005	8.5600000000000005	\N	1	3	3	172435.200000000012	t	\N	\N
79	NATISOL 3 TT - 97	98	20	3	2	130978	2020-11-19 16:15:00	2020-11-21 11:12:27	17.1099999999999994	12.7300000000000004	\N	1	3	1	157173.600000000006	t	\N	\N
80	NATISHEN 4 Ð 108	108	24	4	1	144835	2020-11-19 16:15:00	2020-11-21 11:12:27	10.2100000000000009	9.16000000000000014	\N	1	3	3	173802	t	\N	\N
81	NATIMOVE 4 - 124	124	17	4	2	160899	2020-11-19 16:15:00	2020-11-21 11:12:27	14.3900000000000006	12.4299999999999997	\N	1	3	2	193078.799999999988	t	\N	\N
82	WASABI 4 Ð 100	100	16	4	1	131337	2020-11-19 16:15:00	2020-11-21 11:12:27	15.5399999999999991	9.91999999999999993	\N	1	2	2	157604.399999999994	t	\N	\N
83	NATIMAMBA 3 Ð 103	103	24	3	1	140468	2020-11-19 16:15:00	2020-11-21 11:12:27	17.5199999999999996	10.0600000000000005	\N	1	3	1	168561.600000000006	t	\N	\N
84	NATIGREEN 4	125	19	4	2	164137	2020-11-19 16:15:00	2020-11-21 11:12:27	15	12	\N	1	3	2	196964.399999999994	t	\N	\N
85	NATIVIE 3 TM- 101	101	0	3	2	123965	2020-11-19 16:15:00	2020-11-21 11:12:27	17.3200000000000003	7.36000000000000032	\N	2	3	1	148758	t	\N	\N
86	NATISOON 4 - 104	104	20	4	1	139941	2020-11-19 16:15:00	2020-11-21 11:12:27	11.9199999999999999	12.8699999999999992	\N	3	3	1	167929.200000000012	t	\N	\N
87	ANIS Toiture Terrasse 3 Ð 89	94	17	3	1	125833	2020-11-19 16:15:00	2020-11-21 11:12:27	14.8000000000000007	9.90000000000000036	\N	3	2	1	150999.600000000006	t	\N	\N
88	NATILINE 4 - 102	111	18	4	1	149863	2020-11-19 16:15:00	2020-11-21 11:12:27	12.3000000000000007	8.35999999999999943	\N	1	3	2	179835.600000000006	t	\N	\N
90	NATIREY 4 - AmŽnagealbe	73	55	1	1	126432	2020-11-19 16:15:00	2020-11-21 11:12:27	10.2100000000000009	9.16000000000000014	\N	1	3	3	151718.399999999994	t	\N	\N
91	NATIGREEN 3	102	17	3	1	139436	2020-11-19 16:15:00	2020-11-21 11:12:27	13.4600000000000009	10.1999999999999993	\N	1	3	2	167323.200000000012	t	\N	\N
92	NATISOON 3 - 89	89	20	3	1	125906	2020-11-19 16:15:00	2020-11-21 11:12:27	15.2599999999999998	11.9100000000000001	\N	3	3	1	151087.200000000012	t	\N	\N
93	NATIVIE 3 TT - 101	101	0	3	2	128572	2020-11-19 16:15:00	2020-11-21 11:12:27	17.3200000000000003	7.36000000000000032	\N	3	3	1	154286.399999999994	t	\N	\N
94	NATIWAY 4	123	21	4	2	170948	2020-11-19 16:15:00	2020-11-21 11:12:27	16.7699999999999996	14.0399999999999991	\N	2	3	1	205137.600000000006	t	\N	\N
95	NATILIVE 4 - 96	96	15	4	2	133306	2020-11-19 16:15:00	2020-11-21 11:12:27	9.3100000000000005	10.0600000000000005	\N	1	3	2	159967.200000000012	t	\N	\N
96	NATIWOOD	139	2	4	2	181414	2020-11-19 16:15:00	2020-11-21 11:12:27	11.2400000000000002	9.64000000000000057	\N	3	3	2	217696.799999999988	t	\N	\N
98	NATISOL 4 -107	109	21	4	2	155859	2020-11-19 16:15:00	2020-11-21 11:12:27	17.9100000000000001	12.6699999999999999	\N	3	3	1	187030.799999999988	t	\N	\N
99	NATIMOVE 3 - 103	103	17	3	2	149196	2020-11-19 16:15:00	2020-11-21 11:12:27	13.8900000000000006	10.4299999999999997	\N	1	3	2	179035.200000000012	t	\N	\N
100	NATISOL 3 - 97	98	20	3	2	146836	2020-11-19 16:15:00	2020-11-21 11:12:27	17.1099999999999994	12.7300000000000004	\N	3	3	1	176203.200000000012	t	\N	\N
101	NATIWAY 3	102	21	3	2	153679	2020-11-19 16:15:00	2020-11-21 11:12:27	15.2599999999999998	15.3000000000000007	\N	2	3	1	184414.799999999988	t	\N	\N
102	NATILINE 3 - 92	93	16	3	1	138407	2020-11-19 16:15:00	2020-11-21 11:12:27	11.4100000000000001	7.75999999999999979	\N	1	3	2	166088.399999999994	t	\N	\N
103	NATILIVE 3 - 81	81	15	3	2	124236	2020-11-19 16:15:00	2020-11-21 11:12:27	8.41000000000000014	10.0600000000000005	\N	1	3	2	149083.200000000012	t	\N	\N
104	NATISLIM	95	0	3	1	139169	2020-11-19 16:15:00	2020-11-21 11:12:27	5	13.8200000000000003	\N	1	3	2	167002.799999999988	t	\N	\N
105	NATILIVE 2 - 69	69	0	2	1	105815	2020-11-19 16:15:00	2020-11-21 11:12:27	5.41000000000000014	8.5600000000000005	\N	1	3	2	126978	t	\N	\N
106	NATICUBE 3 - 113	109	17	3	2	185162	2020-11-19 16:15:00	2020-11-21 11:12:27	14.8000000000000007	11	\N	3	3	2	222194.399999999994	t	\N	\N
1	CERISE 4 - 101	101	22	4	1	105730	2020-11-19 16:15:00	2020-11-21 11:12:27	18.6999999999999993	11.5	\N	1	2	2	126876	t	\N	\N
108	SMART-ECO-04	90.3299999999999983	14.5	4	1	87500	2020-11-23 12:45:58	\N	14.5999999999999996	8.5	\N	4	2	1	105000	t	\N	\N
89	Tournette 11.05	114	19	4	2	154451	2020-11-19 16:15:00	2020-11-24 15:44:35	11.0500000000000007	13.1999999999999993	\N	1	1	2	185342	t	\N	\N
74	Silki (Canneberge 5)	129	16	5	2	162290	2020-11-19 16:15:00	2020-11-24 15:45:56	14.5	8	\N	1	1	3	194748	t	\N	\N
212	NewDesign	125	45	34	12	125455	2020-11-26 21:03:17	2020-11-26 21:15:28	12	12	12	2	2	1	150546	t	\N	\N
77	Choqa (Bergamote 3)	93	18	3	1	121800	2020-11-19 16:15:00	2020-12-02 20:40:23	9.80000000000000071	8.80000000000000071	\N	1	1	3	146160	t	Facades-5fbecbb0477232.91289257.pdf	\N
97	NATISHEN 3 - 94	94	19	3	1	134273	2020-11-19 16:15:00	2020-12-04 16:13:45	9.00999999999999979	9.16000000000000014	\N	1	3	3	161128	t	\N	\N
214	TEST2	1	1	1	1	1	2020-11-30 20:52:56	2020-12-08 08:28:07	1	1	\N	1	1	1	2	t	FLEURY-LEDOUX-SITE-INTERNET-5fcf2b07be9353.87275393.pdf	1
\.


--
-- Data for Name: house_brand; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.house_brand (id, name) FROM stdin;
1	Maisons Berdin
2	Villas Club
3	Natilia
\.


--
-- Data for Name: house_model; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.house_model (id, name) FROM stdin;
1	Plain-pied
2	Etage
3	Combles Aménagées
\.


--
-- Data for Name: house_roofing; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.house_roofing (id, name) FROM stdin;
1	Toiture Traditionnelle 35°
2	Toiture Monopente
3	Toiture Terrasse
4	Toiture Traditionelle 30°
\.


--
-- Data for Name: house_style; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.house_style (id, name) FROM stdin;
1	Traditionnel
2	Contemporain
\.


--
-- Data for Name: picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.picture (id, name, house_id) FROM stdin;
1	5fc7eda73d2729.39471960.jpeg	\N
2	5fc7f8b81846a0.18226604.jpg	\N
3	5fc7f8b821a3b6.03330081.jpg	\N
7	5fca4d2ad95da6.70512983.jpg	\N
8	5fca4d2ae48695.28990553.jpg	\N
9	5fca4d2aea0bf2.13484812.jpg	\N
10	5fca4d2af03c39.52060500.jpg	\N
13	5fcf2b07ba28b7.12252106.jpg	214
14	5fcf2b07bb5d45.92555464.jpg	214
16	5fd32d72850317.19854338.jpg	18
17	5fd32d728ddf91.78912391.jpg	18
\.


--
-- Data for Name: plot; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.plot (id, allotment_id, lot, surface, facade_width, selling_price_ati, created_at, updated_at, state_id) FROM stdin;
2	1	2	635	\N	54000	2020-11-27 17:42:42	\N	\N
34	13	15	280	\N	43680	2020-12-04 15:08:45	\N	\N
35	13	17	280	\N	36400	2020-12-04 15:08:45	\N	\N
36	13	19	275	\N	35750	2020-12-04 15:08:45	\N	\N
37	13	20	270	\N	35230	2020-12-04 15:08:45	\N	\N
38	14	11	571	\N	64500	2020-12-04 15:27:19	\N	\N
39	14	9	550	\N	66500	2020-12-04 15:27:19	\N	\N
40	14	7	567	\N	66500	2020-12-04 15:27:19	\N	\N
41	14	6	657	\N	72500	2020-12-04 15:27:19	\N	\N
42	14	2	597	\N	72000	2020-12-04 15:27:19	\N	\N
43	15	3	545	\N	72000	2020-12-04 15:36:34	\N	\N
44	15	4	585	\N	73600	2020-12-04 15:36:35	\N	\N
45	15	5	585	\N	73600	2020-12-04 15:36:35	\N	\N
46	15	6	514	\N	70760	2020-12-04 15:36:35	\N	\N
47	15	11	585	\N	73600	2020-12-04 15:36:35	\N	\N
48	15	12	512	\N	70680	2020-12-04 15:36:35	\N	\N
49	15	13	565	\N	72800	2020-12-04 15:36:35	\N	\N
50	15	14	565	\N	72800	2020-12-04 15:36:35	\N	\N
51	15	15	499	\N	70160	2020-12-04 15:36:35	\N	\N
52	15	16	565	\N	72800	2020-12-04 15:36:35	\N	\N
53	15	17	565	\N	72800	2020-12-04 15:36:35	\N	\N
54	15	18	565	\N	72800	2020-12-04 15:36:35	\N	\N
55	15	19	565	\N	72800	2020-12-04 15:36:35	\N	\N
56	15	20	557	\N	72480	2020-12-04 15:36:35	\N	\N
81	18	7	605	\N	81750	2020-12-04 16:22:44	\N	\N
82	19	parcelle 4	864	\N	124416	2020-12-04 16:29:31	\N	\N
83	19	parcelle 3	894	\N	128736	2020-12-04 16:29:31	\N	\N
84	19	parcelle 1	878	\N	126432	2020-12-04 16:29:31	\N	\N
1	1	1	687	0	57400	2020-11-27 17:42:08	2020-12-05 17:37:13	\N
68	16	17	682	0	70650	2020-12-04 15:46:12	2020-12-08 17:57:47	1
69	16	18	615	0	66550	2020-12-04 15:46:12	2020-12-08 17:57:47	1
70	16	19	614	0	66550	2020-12-04 16:16:50	2020-12-08 17:57:47	1
71	16	20	614	0	66350	2020-12-04 16:16:50	2020-12-08 17:57:47	1
72	16	21	612	0	65000	2020-12-04 16:16:50	2020-12-08 17:57:47	1
79	17	6	600	20	71500	2020-12-04 16:21:29	2020-12-07 21:07:23	1
73	16	23	590	0	65000	2020-12-04 16:16:50	2020-12-08 17:57:47	1
80	17	12	611	0	69000	2020-12-04 16:21:29	2020-12-07 21:17:06	1
6	2	02	500	15	145000	2020-11-29 15:47:35	2020-12-08 09:19:50	1
57	16	2	539	0	62000	2020-12-04 15:46:12	2020-12-08 17:57:47	1
58	16	3	538	0	62000	2020-12-04 15:46:12	2020-12-08 17:57:47	1
59	16	4	538	0	62000	2020-12-04 15:46:12	2020-12-08 17:57:47	1
60	16	6	550	0	62550	2020-12-04 15:46:12	2020-12-08 17:57:47	1
61	16	7	631	0	67500	2020-12-04 15:46:12	2020-12-08 17:57:47	1
62	16	9	666	0	69700	2020-12-04 15:46:12	2020-12-08 17:57:47	1
63	16	11	666	0	69700	2020-12-04 15:46:12	2020-12-08 17:57:47	1
64	16	13	666	0	69700	2020-12-04 15:46:12	2020-12-08 17:57:47	1
65	16	14	666	0	69700	2020-12-04 15:46:12	2020-12-08 17:57:47	1
66	16	15	666	0	69700	2020-12-04 15:46:12	2020-12-08 17:57:47	1
67	16	16	584	0	64700	2020-12-04 15:46:12	2020-12-08 17:57:47	1
74	16	24	589	0	65000	2020-12-04 16:16:50	2020-12-08 17:57:47	1
75	16	25	589	0	65000	2020-12-04 16:16:50	2020-12-08 17:57:47	1
76	16	26	588	0	65000	2020-12-04 16:16:50	2020-12-08 17:57:47	1
77	16	27	657	0	76050	2020-12-04 16:16:50	2020-12-08 17:57:47	1
78	16	28	643	0	68250	2020-12-04 16:16:50	2020-12-08 17:57:47	1
5	2	01	450	16	135000	2020-11-29 15:47:35	2020-12-11 09:30:26	1
85	20	1	762	12	115000	2020-12-04 16:34:33	2020-12-11 12:34:27	1
\.


--
-- Data for Name: society; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.society (id, name, email, phone_number) FROM stdin;
1	Nord Est Aménagement Promotion	e@e.Com	\N
2	Groupe Berdin Aménagement	a@groupeberdin.com	0326080404
3	Notaire Pintaux	anne-laure.pintaux.51066@notaires.fr	03.26.03.49.72 / 06.46.34.55.69
4	Erlon immobilier	tdru@erlon-immobilier.com	06.07.45.80.50
5	Brooks Immobilier	sb@brooks-immobilier.fr	\N
6	L'AGENCE Reims	lagence.as@orange.fr	03 26 86 67 29
7	Venteoulocation - Reims - Orpi	reimsfoch@orpi.com	03.26.06.51.51
8	ConstruirOgaz	construirogaz@grdf.fr	\N
9	SCP A. DELANNOY ET M. JACQUES	delannoy.jacques@notaires.fr	03.24.72.95.59
10	Sacclo	vincent.perrin@sacclo.fr	+33 6 63 23 50 75
11	OFFICE NOTARIAL DE CHAMPAGNE	estelle.barret.51025@notaires.fr	06.32.01.63.23
\.


--
-- Data for Name: state; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.state (id, name) FROM stdin;
1	Libre
2	Réservé
3	Vendu
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."user" (id, email, roles, password, first_name, last_name) FROM stdin;
1	thibaud.berdin@groupeberdin.com	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$+PjFuLYTXn0OO3SYXz+4OQ$KXho91KVe5ij6w36lMZt4YkFnzP+5EbqvMJF3Q1TZH8	Thibaud	Berdin
12	ricard.lefief@groupeberdin.com	["ROLE_USER"]	$argon2id$v=19$m=65536,t=4,p=1$6WpWgMgN6P1xPBkMPoSe8A$FKf97M3IUQ7346GUQ1GNWH//ufswQs8C8CMNfTwxDY0	Richard	\N
13	pj.raulet@groupeberdin.com	["ROLE_USER"]	$argon2id$v=19$m=65536,t=4,p=1$kEau+/2ApmYGIRElltXUFw$Q6AksT+0sdQi1JJZ0JmGrxzabaCw5KW9FaIH4g0tQgo	Pierre-Jean	Raumet
2	tessa@groupeberdin.com	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$9aHHzPB8xf0zHPYerg1c9A$ggPgq66eVeNa6Rgdpyx3gWgaPnyx9Q1TThaWd3B+oAI	Tessa	\N
\.


--
-- Name: allotment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.allotment_id_seq', 20, true);


--
-- Name: contact_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.contact_id_seq', 11, true);


--
-- Name: house_brand_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.house_brand_id_seq', 1, false);


--
-- Name: house_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.house_id_seq', 214, true);


--
-- Name: house_model_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.house_model_id_seq', 1, false);


--
-- Name: house_roofing_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.house_roofing_id_seq', 1, false);


--
-- Name: house_style_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.house_style_id_seq', 2, true);


--
-- Name: picture_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.picture_id_seq', 17, true);


--
-- Name: plot_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.plot_id_seq', 86, true);


--
-- Name: society_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.society_id_seq', 11, true);


--
-- Name: state_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.state_id_seq', 3, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.user_id_seq', 13, true);


--
-- Name: allotment_contact allotment_contact_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.allotment_contact
    ADD CONSTRAINT allotment_contact_pkey PRIMARY KEY (allotment_id, contact_id);


--
-- Name: allotment_house_roofing allotment_house_roofing_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.allotment_house_roofing
    ADD CONSTRAINT allotment_house_roofing_pkey PRIMARY KEY (allotment_id, house_roofing_id);


--
-- Name: allotment allotment_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.allotment
    ADD CONSTRAINT allotment_pkey PRIMARY KEY (id);


--
-- Name: contact contact_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contact
    ADD CONSTRAINT contact_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: house_brand house_brand_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house_brand
    ADD CONSTRAINT house_brand_pkey PRIMARY KEY (id);


--
-- Name: house_model house_model_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house_model
    ADD CONSTRAINT house_model_pkey PRIMARY KEY (id);


--
-- Name: house house_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT house_pkey PRIMARY KEY (id);


--
-- Name: house_roofing house_roofing_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house_roofing
    ADD CONSTRAINT house_roofing_pkey PRIMARY KEY (id);


--
-- Name: house_style house_style_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house_style
    ADD CONSTRAINT house_style_pkey PRIMARY KEY (id);


--
-- Name: picture picture_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.picture
    ADD CONSTRAINT picture_pkey PRIMARY KEY (id);


--
-- Name: plot plot_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.plot
    ADD CONSTRAINT plot_pkey PRIMARY KEY (id);


--
-- Name: society society_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.society
    ADD CONSTRAINT society_pkey PRIMARY KEY (id);


--
-- Name: state state_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.state
    ADD CONSTRAINT state_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: idx_16db4f896bb74515; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_16db4f896bb74515 ON public.picture USING btree (house_id);


--
-- Name: idx_469cf8d31bf0861f; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_469cf8d31bf0861f ON public.allotment_house_roofing USING btree (allotment_id);


--
-- Name: idx_469cf8d324d9b445; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_469cf8d324d9b445 ON public.allotment_house_roofing USING btree (house_roofing_id);


--
-- Name: idx_4c62e638e6389d24; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_4c62e638e6389d24 ON public.contact USING btree (society_id);


--
-- Name: idx_67d5399d1ae70cb8; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_67d5399d1ae70cb8 ON public.house USING btree (house_model_id);


--
-- Name: idx_67d5399d24d9b445; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_67d5399d24d9b445 ON public.house USING btree (house_roofing_id);


--
-- Name: idx_67d5399d27676b57; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_67d5399d27676b57 ON public.house USING btree (house_brand_id);


--
-- Name: idx_67d5399dd95fdb2b; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_67d5399dd95fdb2b ON public.house USING btree (house_style_id);


--
-- Name: idx_ac17dbdf1bf0861f; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ac17dbdf1bf0861f ON public.allotment_contact USING btree (allotment_id);


--
-- Name: idx_ac17dbdfe7a1254a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ac17dbdfe7a1254a ON public.allotment_contact USING btree (contact_id);


--
-- Name: idx_bebb8f891bf0861f; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_bebb8f891bf0861f ON public.plot USING btree (allotment_id);


--
-- Name: idx_bebb8f895d83cc1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_bebb8f895d83cc1 ON public.plot USING btree (state_id);


--
-- Name: uniq_67d5399d5e237e06; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX uniq_67d5399d5e237e06 ON public.house USING btree (name);


--
-- Name: uniq_8d93d649e7927c74; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON public."user" USING btree (email);


--
-- Name: picture fk_16db4f896bb74515; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.picture
    ADD CONSTRAINT fk_16db4f896bb74515 FOREIGN KEY (house_id) REFERENCES public.house(id);


--
-- Name: allotment_house_roofing fk_469cf8d31bf0861f; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.allotment_house_roofing
    ADD CONSTRAINT fk_469cf8d31bf0861f FOREIGN KEY (allotment_id) REFERENCES public.allotment(id) ON DELETE CASCADE;


--
-- Name: allotment_house_roofing fk_469cf8d324d9b445; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.allotment_house_roofing
    ADD CONSTRAINT fk_469cf8d324d9b445 FOREIGN KEY (house_roofing_id) REFERENCES public.house_roofing(id) ON DELETE CASCADE;


--
-- Name: contact fk_4c62e638e6389d24; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contact
    ADD CONSTRAINT fk_4c62e638e6389d24 FOREIGN KEY (society_id) REFERENCES public.society(id);


--
-- Name: house fk_67d5399d1ae70cb8; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT fk_67d5399d1ae70cb8 FOREIGN KEY (house_model_id) REFERENCES public.house_model(id);


--
-- Name: house fk_67d5399d24d9b445; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT fk_67d5399d24d9b445 FOREIGN KEY (house_roofing_id) REFERENCES public.house_roofing(id);


--
-- Name: house fk_67d5399d27676b57; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT fk_67d5399d27676b57 FOREIGN KEY (house_brand_id) REFERENCES public.house_brand(id);


--
-- Name: house fk_67d5399dd95fdb2b; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT fk_67d5399dd95fdb2b FOREIGN KEY (house_style_id) REFERENCES public.house_style(id);


--
-- Name: allotment_contact fk_ac17dbdf1bf0861f; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.allotment_contact
    ADD CONSTRAINT fk_ac17dbdf1bf0861f FOREIGN KEY (allotment_id) REFERENCES public.allotment(id) ON DELETE CASCADE;


--
-- Name: allotment_contact fk_ac17dbdfe7a1254a; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.allotment_contact
    ADD CONSTRAINT fk_ac17dbdfe7a1254a FOREIGN KEY (contact_id) REFERENCES public.contact(id) ON DELETE CASCADE;


--
-- Name: plot fk_bebb8f891bf0861f; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.plot
    ADD CONSTRAINT fk_bebb8f891bf0861f FOREIGN KEY (allotment_id) REFERENCES public.allotment(id);


--
-- Name: plot fk_bebb8f895d83cc1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.plot
    ADD CONSTRAINT fk_bebb8f895d83cc1 FOREIGN KEY (state_id) REFERENCES public.state(id);


--
-- PostgreSQL database dump complete
--

