--
-- PostgreSQL database cluster dump
--

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE main;
ALTER ROLE main WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS PASSWORD 'md5573d77b6c3d08052695c807a7021c91f';






\connect template1

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.10
-- Dumped by pg_dump version 11.10

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

--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.10
-- Dumped by pg_dump version 11.10

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

--
-- Name: main; Type: DATABASE; Schema: -; Owner: main
--

CREATE DATABASE main WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE main OWNER TO main;

\connect main

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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: allotment; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.allotment (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    postal_code integer NOT NULL,
    city character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.allotment OWNER TO main;

--
-- Name: allotment_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.allotment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.allotment_id_seq OWNER TO main;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO main;

--
-- Name: house; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.house (
    id integer NOT NULL,
    house_roofing_id integer,
    house_brand_id integer,
    house_model_id integer,
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
    selling_price_ati double precision,
    valid boolean NOT NULL,
    plan_filename character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.house OWNER TO main;

--
-- Name: house_brand; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.house_brand (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.house_brand OWNER TO main;

--
-- Name: house_brand_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.house_brand_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.house_brand_id_seq OWNER TO main;

--
-- Name: house_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.house_id_seq
    START WITH 200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.house_id_seq OWNER TO main;

--
-- Name: house_model; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.house_model (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.house_model OWNER TO main;

--
-- Name: house_model_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.house_model_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.house_model_id_seq OWNER TO main;

--
-- Name: house_roofing; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.house_roofing (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.house_roofing OWNER TO main;

--
-- Name: house_roofing_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.house_roofing_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.house_roofing_id_seq OWNER TO main;

--
-- Name: plot; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.plot (
    id integer NOT NULL,
    allotment_id integer NOT NULL,
    lot character varying(255) NOT NULL,
    surface double precision NOT NULL,
    facade_width double precision,
    selling_price_ati double precision NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.plot OWNER TO main;

--
-- Name: plot_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.plot_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.plot_id_seq OWNER TO main;

--
-- Name: user; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public."user" OWNER TO main;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO main;

--
-- Data for Name: allotment; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.allotment (id, name, postal_code, city, created_at, updated_at) FROM stdin;
2	MontépilloisCormontreuil	51430	Cormontreuil	2020-11-27 15:50:23	2020-11-27 16:50:55
9	TestLots	511000	Reims	2020-11-27 18:46:30	\N
10	aaaa	1	aaa	2020-11-27 22:13:00	\N
11	Ajout2	51100	Reims	2020-11-28 15:03:46	\N
12	Univers	989998	Ciel	2020-11-28 16:01:28	2020-11-30 08:28:34
3	Juniville Lotissement	80	Juniville	2020-11-27 18:07:38	2020-11-30 13:55:14
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20201121162100	2020-11-21 16:31:45	53
DoctrineMigrations\\Version20201124213557	2020-11-24 21:36:26	89
DoctrineMigrations\\Version20201126203446	2020-11-26 20:35:04	72
DoctrineMigrations\\Version20201127151517	2020-11-27 15:17:03	135
DoctrineMigrations\\Version20201127154756	2020-11-27 15:48:53	41
DoctrineMigrations\\Version20201128143349	2020-11-28 15:35:29	90
\.


--
-- Data for Name: house; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.house (id, house_roofing_id, house_brand_id, house_model_id, name, living_space, annex_surface, room_number, bathroom_number, selling_price_df, created_at, updated_at, length, width, height, selling_price_ati, valid, plan_filename) FROM stdin;
212	2	2	1	NewDesign	125	45	34	12	125455	2020-11-26 21:03:17	2020-11-26 21:15:28	12	12	12	150546	t	\N
206	1	1	1	Maison Rose	125	45	4	2	125485	2020-11-25 19:30:37	2020-11-27 17:57:29	2231	121	110	150582	t	\N
\.


--
-- Data for Name: house_brand; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.house_brand (id, name) FROM stdin;
1	Maisons Berdin
2	Villa Club
3	Natilia
\.


--
-- Data for Name: house_model; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.house_model (id, name) FROM stdin;
1	Plain-pied
2	Etage
3	Combles Aménagées
\.


--
-- Data for Name: house_roofing; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.house_roofing (id, name) FROM stdin;
1	Toiture Traditionnelle 35°
2	Toiture Monopente
3	Toiture Terrasse
\.


--
-- Data for Name: plot; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.plot (id, allotment_id, lot, surface, facade_width, selling_price_ati, created_at, updated_at) FROM stdin;
1	2	02	2	2	2	2020-11-27 17:10:11	2020-11-28 16:35:47
22	3	0303	3	3	30	2020-11-28 17:27:05	\N
23	3	04	4	4	4	2020-11-28 17:27:29	\N
25	11	03	3	3	3	2020-11-28 21:23:58	\N
26	11	04	4	4	4	2020-11-28 21:23:58	\N
15	11	2bis	650	30	135000	2020-11-28 15:03:46	2020-11-28 21:23:58
11	9	02	2	2	2	2020-11-27 18:46:30	2020-11-28 21:39:07
30	12	Stanley	4555	5454	5445	2020-11-28 21:43:05	\N
29	12	2001OdysseyDe L espace	145	45	458200	2020-11-28 21:42:17	2020-11-28 21:43:05
31	12	Fusee	44	44	44	2020-11-28 21:47:42	\N
12	9	789	11111	11	111	2020-11-27 18:46:30	2020-11-29 19:12:29
33	12	Espace	4568787	1239898	985899	2020-11-30 08:28:15	\N
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public."user" (id, email, roles, password, first_name, last_name) FROM stdin;
8	zaz@azaza.com	[]	$argon2id$v=19$m=65536,t=4,p=1$WbVM7ATYZZs1vvng4TW9rA$vZGzSKO/wEDc98QnzJD4dGYtwdrc7qevdpFLKaKipow	\N	\N
9	c@c.com	["ROLE_USER"]	$argon2id$v=19$m=65536,t=4,p=1$xjvAoKDnTEaNjrCAhae3oQ$RG197ig38fLPaotax/mqcJq3pWlp83cTt0ErnCb0qaQ	\N	\N
2	t@t.com	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$3/1e0E5iRp9OcSw+6lW79A$iG+88b8yfX/br5VngwuMhntdyYryYsGhgmnCb19GMNQ	Tuli	lipo
11	j.moro@wanadoo.fr	["ROLE_USER"]	$argon2id$v=19$m=65536,t=4,p=1$55Od125cKTpOmIBSFjVZ2A$VwZvVqfjFrEPgTtGYU0PctwFwD4klWXDGLc/9JhZRZQ	Gerard	Moro
10	l@l.com	["ROLE_USER"]	$argon2id$v=19$m=65536,t=4,p=1$inHrQTE7ID7NUPgMjnXFRw$g/s01Jr7RB4knyVabuHaiVlEvsjLBgCX+OKVuLZ+V2E	lucien	Ritui
\.


--
-- Name: allotment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.allotment_id_seq', 12, true);


--
-- Name: house_brand_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.house_brand_id_seq', 1, false);


--
-- Name: house_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.house_id_seq', 212, true);


--
-- Name: house_model_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.house_model_id_seq', 1, false);


--
-- Name: house_roofing_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.house_roofing_id_seq', 1, false);


--
-- Name: plot_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.plot_id_seq', 33, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.user_id_seq', 11, true);


--
-- Name: allotment allotment_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.allotment
    ADD CONSTRAINT allotment_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: house_brand house_brand_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.house_brand
    ADD CONSTRAINT house_brand_pkey PRIMARY KEY (id);


--
-- Name: house_model house_model_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.house_model
    ADD CONSTRAINT house_model_pkey PRIMARY KEY (id);


--
-- Name: house house_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT house_pkey PRIMARY KEY (id);


--
-- Name: house_roofing house_roofing_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.house_roofing
    ADD CONSTRAINT house_roofing_pkey PRIMARY KEY (id);


--
-- Name: plot plot_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.plot
    ADD CONSTRAINT plot_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: idx_67d5399d1ae70cb8; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_67d5399d1ae70cb8 ON public.house USING btree (house_model_id);


--
-- Name: idx_67d5399d24d9b445; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_67d5399d24d9b445 ON public.house USING btree (house_roofing_id);


--
-- Name: idx_67d5399d27676b57; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_67d5399d27676b57 ON public.house USING btree (house_brand_id);


--
-- Name: idx_bebb8f891bf0861f; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_bebb8f891bf0861f ON public.plot USING btree (allotment_id);


--
-- Name: uniq_67d5399d5e237e06; Type: INDEX; Schema: public; Owner: main
--

CREATE UNIQUE INDEX uniq_67d5399d5e237e06 ON public.house USING btree (name);


--
-- Name: uniq_8d93d649e7927c74; Type: INDEX; Schema: public; Owner: main
--

CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON public."user" USING btree (email);


--
-- Name: house fk_67d5399d1ae70cb8; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT fk_67d5399d1ae70cb8 FOREIGN KEY (house_model_id) REFERENCES public.house_model(id);


--
-- Name: house fk_67d5399d24d9b445; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT fk_67d5399d24d9b445 FOREIGN KEY (house_roofing_id) REFERENCES public.house_roofing(id);


--
-- Name: house fk_67d5399d27676b57; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.house
    ADD CONSTRAINT fk_67d5399d27676b57 FOREIGN KEY (house_brand_id) REFERENCES public.house_brand(id);


--
-- Name: plot fk_bebb8f891bf0861f; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.plot
    ADD CONSTRAINT fk_bebb8f891bf0861f FOREIGN KEY (allotment_id) REFERENCES public.allotment(id);


--
-- PostgreSQL database dump complete
--

\connect postgres

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.10
-- Dumped by pg_dump version 11.10

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

--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database cluster dump complete
--

