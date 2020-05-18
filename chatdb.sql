--
-- PostgreSQL database dump
--

-- Dumped from database version 11.7 (Debian 11.7-0+deb10u1)
-- Dumped by pg_dump version 12.2

-- Started on 2020-05-18 10:19:38

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
-- TOC entry 199 (class 1259 OID 20471)
-- Name: message_idgen; Type: SEQUENCE; Schema: public; Owner: chat
--

CREATE SEQUENCE public.message_idgen
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.message_idgen OWNER TO chat;

SET default_tablespace = '';

--
-- TOC entry 198 (class 1259 OID 20453)
-- Name: message; Type: TABLE; Schema: public; Owner: chat
--

CREATE TABLE public.message (
    id bigint DEFAULT nextval('public.message_idgen'::regclass) NOT NULL,
    roomname character varying(20) NOT NULL,
    username character varying(20) NOT NULL,
    text character varying(500) NOT NULL,
    createtime timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.message OWNER TO chat;

--
-- TOC entry 196 (class 1259 OID 16386)
-- Name: room; Type: TABLE; Schema: public; Owner: chat
--

CREATE TABLE public.room (
    name character varying(20) NOT NULL,
    description character varying(200),
    createtime timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.room OWNER TO chat;

--
-- TOC entry 197 (class 1259 OID 16391)
-- Name: user; Type: TABLE; Schema: public; Owner: chat
--

CREATE TABLE public."user" (
    name character varying(20) NOT NULL,
    color character varying(6) DEFAULT 0 NOT NULL,
    lastlogin timestamp without time zone,
    createtime timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public."user" OWNER TO chat;

--
-- TOC entry 2925 (class 0 OID 20453)
-- Dependencies: 198
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: chat
--

COPY public.message (id, roomname, username, text, createtime) FROM stdin;
1	Wohnzimmer	mlessiak	dies ist ein test	2020-04-15 19:26:09.315375
4	Wohnzimmer	mlessiak	und noch ei ner	2020-04-27 18:00:47.552142
5	Wohnzimmer	mlessiak	und noch e in dritter	2020-04-27 18:11:06.101316
6	Wohnzimmer	klessiak	jetzt mal meins testen	2020-04-27 18:12:08.257166
7	Wohnzimmer	mlessiak	und eine antwort	2020-04-27 18:12:15.999319
8	Wohnzimmer	klessiak	ja das sehe ich auch so	2020-04-27 18:30:27.608183
9	Wohnzimmer	mlessiak	aber wieso?	2020-04-27 18:30:36.79279
10	Wohnzimmer	fixfoxi300	ich bin auch da	2020-04-27 19:06:14.268235
11	Wohnzimmer	mlessiak	noch in zwie	2020-04-27 19:07:28.546678
12	Wohnzimmer	mlessiak	auch jetzt super	2020-04-27 19:08:41.619038
13	Wohnzimmer	mlessiak	und noch eins	2020-04-27 19:08:53.671971
14	Wohnzimmer	mlessiak	wieso nicht produktiv	2020-04-27 19:09:16.787941
15	Wohnzimmer	mlessiak	nochmal	2020-04-27 19:10:48.117945
\.


--
-- TOC entry 2923 (class 0 OID 16386)
-- Dependencies: 196
-- Data for Name: room; Type: TABLE DATA; Schema: public; Owner: chat
--

COPY public.room (name, description, createtime) FROM stdin;
Wohnzimmer	gemütlicher Tratsch	2020-04-13 12:08:38.744704
Hilfe	Rat&Tat	2020-04-13 12:08:38.744704
\.


--
-- TOC entry 2924 (class 0 OID 16391)
-- Dependencies: 197
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: chat
--

COPY public."user" (name, color, lastlogin, createtime) FROM stdin;
mlessiak	00ffae	\N	2020-04-13 12:08:38.744704
mriege	000cff	\N	2020-04-13 12:08:38.744704
klessiak	ababab	2020-04-17 10:02:40.57136	2020-04-17 10:02:40.57136
test15000	9fe8b5	2020-04-27 16:17:31.487875	2020-04-27 16:17:31.487875
testi8878	3E1279	2020-04-27 16:29:31.846855	2020-04-27 16:29:31.846855
testi789	314DF7	2020-04-27 16:31:16.563766	2020-04-27 16:31:16.563766
tesiaberjetz	CC51C5	2020-04-27 16:31:47.632226	2020-04-27 16:31:47.632226
fixfoxi300	DBFEA6	2020-04-27 19:06:09.068528	2020-04-27 19:06:09.068528
\.


--
-- TOC entry 2932 (class 0 OID 0)
-- Dependencies: 199
-- Name: message_idgen; Type: SEQUENCE SET; Schema: public; Owner: chat
--

SELECT pg_catalog.setval('public.message_idgen', 15, true);


--
-- TOC entry 2798 (class 2606 OID 20460)
-- Name: message message_pkey; Type: CONSTRAINT; Schema: public; Owner: chat
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT message_pkey PRIMARY KEY (id);


--
-- TOC entry 2794 (class 2606 OID 16390)
-- Name: room room_pkey; Type: CONSTRAINT; Schema: public; Owner: chat
--

ALTER TABLE ONLY public.room
    ADD CONSTRAINT room_pkey PRIMARY KEY (name);


--
-- TOC entry 2796 (class 2606 OID 16395)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: chat
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (name);


--
-- TOC entry 2799 (class 1259 OID 20474)
-- Name: roomnameidx; Type: INDEX; Schema: public; Owner: chat
--

CREATE INDEX roomnameidx ON public.message USING btree (roomname, createtime);


--
-- TOC entry 2800 (class 2606 OID 20461)
-- Name: message roomname; Type: FK CONSTRAINT; Schema: public; Owner: chat
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT roomname FOREIGN KEY (roomname) REFERENCES public.room(name);


--
-- TOC entry 2801 (class 2606 OID 20466)
-- Name: message username; Type: FK CONSTRAINT; Schema: public; Owner: chat
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT username FOREIGN KEY (username) REFERENCES public."user"(name);


-- Completed on 2020-05-18 10:19:39

--
-- PostgreSQL database dump complete
--

