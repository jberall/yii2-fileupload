--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.1
-- Dumped by pg_dump version 9.6.1

-- Started on 2017-02-02 11:06:31

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 194 (class 1259 OID 43073)
-- Name: file_upload; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE file_upload (
    id bigint NOT NULL,
    _id uuid,
    notes text,
    file_blob bytea,
    name character varying(512),
    mime_type character varying(255),
    size numeric,
    web_file_name character varying(50),
    save_type smallint,
    created_at bigint,
    updated_at bigint,
    created_by bigint,
    updated_by bigint
);


ALTER TABLE file_upload OWNER TO postgres;

--
-- TOC entry 2243 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN file_upload.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN file_upload.name IS 'name of file at upload time';


--
-- TOC entry 2244 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN file_upload.size; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN file_upload.size IS 'size of file uploaded';


--
-- TOC entry 2245 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN file_upload.web_file_name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN file_upload.web_file_name IS 'name of the file stored on our web.
We use the Yii::$app->security->generateRandomString() to get a unique name per file.';


--
-- TOC entry 2246 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN file_upload.save_type; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN file_upload.save_type IS '1 = Binary Only,
2 = File Only,
3 = Both Binary and File';


--
-- TOC entry 193 (class 1259 OID 43071)
-- Name: file_upload_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE file_upload_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_upload_id_seq OWNER TO postgres;

--
-- TOC entry 2247 (class 0 OID 0)
-- Dependencies: 193
-- Name: file_upload_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE file_upload_id_seq OWNED BY file_upload.id;


--
-- TOC entry 2117 (class 2604 OID 43076)
-- Name: file_upload id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY file_upload ALTER COLUMN id SET DEFAULT nextval('file_upload_id_seq'::regclass);


--
-- TOC entry 2238 (class 0 OID 43073)
-- Dependencies: 194
-- Data for Name: file_upload; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY file_upload (id, _id, notes, file_blob, name, mime_type, size, web_file_name, save_type, created_at, updated_at, created_by, updated_by) FROM stdin;
\.


--
-- TOC entry 2248 (class 0 OID 0)
-- Dependencies: 193
-- Name: file_upload_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('file_upload_id_seq', 13, true);


--
-- TOC entry 2119 (class 2606 OID 43081)
-- Name: file_upload file_upload_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY file_upload
    ADD CONSTRAINT file_upload_id_pkey PRIMARY KEY (id);


-- Completed on 2017-02-02 11:06:32

--
-- PostgreSQL database dump complete
--

