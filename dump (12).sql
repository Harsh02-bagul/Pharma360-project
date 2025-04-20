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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: tbladdress; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbladdress (
    aid integer NOT NULL,
    uid integer,
    aname text
);


ALTER TABLE tbladdress OWNER TO postgres;

--
-- Name: tbladdress_addressid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbladdress_addressid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tbladdress_addressid_seq OWNER TO postgres;

--
-- Name: tbladdress_addressid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbladdress_addressid_seq OWNED BY tbladdress.aid;


--
-- Name: tbladmin; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbladmin (
    adminid integer NOT NULL,
    aemail character varying(30),
    apass character varying(20)
);


ALTER TABLE tbladmin OWNER TO postgres;

--
-- Name: tbladmin_adminid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbladmin_adminid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tbladmin_adminid_seq OWNER TO postgres;

--
-- Name: tbladmin_adminid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbladmin_adminid_seq OWNED BY tbladmin.adminid;


--
-- Name: tblcart; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcart (
    cartid integer NOT NULL,
    pid integer,
    uid integer,
    qty integer,
    status character varying(50),
    ddate text,
    ttime text,
    paid integer,
    aid integer
);


ALTER TABLE tblcart OWNER TO postgres;

--
-- Name: tblcart_cartid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcart_cartid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tblcart_cartid_seq OWNER TO postgres;

--
-- Name: tblcart_cartid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblcart_cartid_seq OWNED BY tblcart.cartid;


--
-- Name: tblcategory; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblcategory (
    cid integer NOT NULL,
    cname character varying(30)
);


ALTER TABLE tblcategory OWNER TO postgres;

--
-- Name: tblcategory_cid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblcategory_cid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tblcategory_cid_seq OWNER TO postgres;

--
-- Name: tblcategory_cid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblcategory_cid_seq OWNED BY tblcategory.cid;


--
-- Name: tblfeedback; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblfeedback (
    fid integer NOT NULL,
    fname character varying(50),
    uid integer
);


ALTER TABLE tblfeedback OWNER TO postgres;

--
-- Name: tblfeedback_fid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblfeedback_fid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tblfeedback_fid_seq OWNER TO postgres;

--
-- Name: tblfeedback_fid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblfeedback_fid_seq OWNED BY tblfeedback.fid;


--
-- Name: tblproduct; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tblproduct (
    pid integer NOT NULL,
    cid integer,
    pname character varying,
    pprice numeric(7,2),
    pdprice numeric(7,2),
    pdesc text,
    pstock integer,
    pimage text,
    pvideo text
);


ALTER TABLE tblproduct OWNER TO postgres;

--
-- Name: tblproduct_pid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tblproduct_pid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tblproduct_pid_seq OWNER TO postgres;

--
-- Name: tblproduct_pid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tblproduct_pid_seq OWNED BY tblproduct.pid;


--
-- Name: tbluser; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbluser (
    uid integer NOT NULL,
    firstname character varying(20),
    upass character varying(50),
    lastname character varying(20),
    email character varying(30),
    gender character varying(10),
    phone bigint
);


ALTER TABLE tbluser OWNER TO postgres;

--
-- Name: tbluser_uid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbluser_uid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tbluser_uid_seq OWNER TO postgres;

--
-- Name: tbluser_uid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbluser_uid_seq OWNED BY tbluser.uid;


--
-- Name: aid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbladdress ALTER COLUMN aid SET DEFAULT nextval('tbladdress_addressid_seq'::regclass);


--
-- Name: adminid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbladmin ALTER COLUMN adminid SET DEFAULT nextval('tbladmin_adminid_seq'::regclass);


--
-- Name: cartid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcart ALTER COLUMN cartid SET DEFAULT nextval('tblcart_cartid_seq'::regclass);


--
-- Name: cid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcategory ALTER COLUMN cid SET DEFAULT nextval('tblcategory_cid_seq'::regclass);


--
-- Name: fid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblfeedback ALTER COLUMN fid SET DEFAULT nextval('tblfeedback_fid_seq'::regclass);


--
-- Name: pid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproduct ALTER COLUMN pid SET DEFAULT nextval('tblproduct_pid_seq'::regclass);


--
-- Name: uid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbluser ALTER COLUMN uid SET DEFAULT nextval('tbluser_uid_seq'::regclass);


--
-- Data for Name: tbladdress; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbladdress (aid, uid, aname) FROM stdin;
\.


--
-- Name: tbladdress_addressid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbladdress_addressid_seq', 1, false);


--
-- Data for Name: tbladmin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbladmin (adminid, aemail, apass) FROM stdin;
\.


--
-- Name: tbladmin_adminid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbladmin_adminid_seq', 1, false);


--
-- Data for Name: tblcart; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcart (cartid, pid, uid, qty, status, ddate, ttime, paid, aid) FROM stdin;
\.


--
-- Name: tblcart_cartid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcart_cartid_seq', 1, false);


--
-- Data for Name: tblcategory; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblcategory (cid, cname) FROM stdin;
\.


--
-- Name: tblcategory_cid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblcategory_cid_seq', 1, false);


--
-- Data for Name: tblfeedback; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblfeedback (fid, fname, uid) FROM stdin;
\.


--
-- Name: tblfeedback_fid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblfeedback_fid_seq', 1, false);


--
-- Data for Name: tblproduct; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tblproduct (pid, cid, pname, pprice, pdprice, pdesc, pstock, pimage, pvideo) FROM stdin;
\.


--
-- Name: tblproduct_pid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tblproduct_pid_seq', 1, false);


--
-- Data for Name: tbluser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbluser (uid, firstname, upass, lastname, email, gender, phone) FROM stdin;
\.


--
-- Name: tbluser_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbluser_uid_seq', 1, false);


--
-- Name: tbladdress_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbladdress
    ADD CONSTRAINT tbladdress_pkey PRIMARY KEY (aid);


--
-- Name: tbladmin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbladmin
    ADD CONSTRAINT tbladmin_pkey PRIMARY KEY (adminid);


--
-- Name: tblcart_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcart
    ADD CONSTRAINT tblcart_pkey PRIMARY KEY (cartid);


--
-- Name: tblcategory_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblcategory
    ADD CONSTRAINT tblcategory_pkey PRIMARY KEY (cid);


--
-- Name: tblfeedback_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblfeedback
    ADD CONSTRAINT tblfeedback_pkey PRIMARY KEY (fid);


--
-- Name: tblproduct_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tblproduct
    ADD CONSTRAINT tblproduct_pkey PRIMARY KEY (pid);


--
-- Name: tbluser_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbluser
    ADD CONSTRAINT tbluser_email_key UNIQUE (email);


--
-- Name: tbluser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbluser
    ADD CONSTRAINT tbluser_pkey PRIMARY KEY (uid);


--
-- Name: tbladdress_uid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbladdress
    ADD CONSTRAINT tbladdress_uid_fkey FOREIGN KEY (uid) REFERENCES tbluser(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tblcart_pid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcart
    ADD CONSTRAINT tblcart_pid_fkey FOREIGN KEY (pid) REFERENCES tblproduct(pid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tblcart_uid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblcart
    ADD CONSTRAINT tblcart_uid_fkey FOREIGN KEY (uid) REFERENCES tbluser(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tblproduct_cid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tblproduct
    ADD CONSTRAINT tblproduct_cid_fkey FOREIGN KEY (cid) REFERENCES tblcategory(cid) ON UPDATE CASCADE ON DELETE CASCADE;


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

