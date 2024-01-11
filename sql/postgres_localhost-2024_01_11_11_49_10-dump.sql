--
-- PostgreSQL database dump
--

-- Dumped from database version 14.10
-- Dumped by pg_dump version 14.10

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

SET default_table_access_method = heap;

--
-- Name: configs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.configs (
    id character varying(255) NOT NULL,
    value character varying(255) NOT NULL
);


ALTER TABLE public.configs OWNER TO postgres;

--
-- Name: i18n_sources; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.i18n_sources (
    id integer NOT NULL,
    category character varying(255) NOT NULL,
    key character varying(255) NOT NULL
);


ALTER TABLE public.i18n_sources OWNER TO postgres;

--
-- Name: i18n_sources_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.i18n_sources_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.i18n_sources_id_seq OWNER TO postgres;

--
-- Name: i18n_sources_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.i18n_sources_id_seq OWNED BY public.i18n_sources.id;


--
-- Name: i18n_translations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.i18n_translations (
    source_id integer NOT NULL,
    language character varying(255) NOT NULL,
    message character varying(255) NOT NULL
);


ALTER TABLE public.i18n_translations OWNER TO postgres;

--
-- Name: languages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.languages (
    code character varying(255) NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.languages OWNER TO postgres;

--
-- Name: media; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.media (
    id integer NOT NULL,
    disk character varying(32) NOT NULL,
    directory character varying(255) NOT NULL,
    filename character varying(255) NOT NULL,
    extension character varying(32) NOT NULL,
    mime_type character varying(128) NOT NULL,
    aggregate_type character varying(32) NOT NULL,
    size integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    variant_name character varying(255),
    original_media_id integer
);


ALTER TABLE public.media OWNER TO postgres;

--
-- Name: media_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.media_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.media_id_seq OWNER TO postgres;

--
-- Name: media_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.media_id_seq OWNED BY public.media.id;


--
-- Name: mediables; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mediables (
    media_id integer NOT NULL,
    mediable_type character varying(255) NOT NULL,
    mediable_id integer NOT NULL,
    tag character varying(255) NOT NULL,
    "order" integer NOT NULL
);


ALTER TABLE public.mediables OWNER TO postgres;

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: news; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.news (
    id bigint NOT NULL,
    img character varying(255) NOT NULL,
    publish_at date NOT NULL,
    type character varying(255) NOT NULL,
    status smallint DEFAULT '1'::smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    CONSTRAINT news_type_check CHECK (((type)::text = ANY ((ARRAY['announce'::character varying, 'news'::character varying])::text[])))
);


ALTER TABLE public.news OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.news_id_seq OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;


--
-- Name: news_translations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.news_translations (
    news_id integer NOT NULL,
    language character varying(255) NOT NULL,
    title character varying(255) NOT NULL,
    short_description text NOT NULL,
    description text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.news_translations OWNER TO postgres;

--
-- Name: permission_group_permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permission_group_permissions (
    permission_group_id integer NOT NULL,
    permission_id integer NOT NULL
);


ALTER TABLE public.permission_group_permissions OWNER TO postgres;

--
-- Name: permission_groups; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permission_groups (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permission_groups OWNER TO postgres;

--
-- Name: permission_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permission_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permission_groups_id_seq OWNER TO postgres;

--
-- Name: permission_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permission_groups_id_seq OWNED BY public.permission_groups.id;


--
-- Name: permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    display_name character varying(255),
    parent_id integer
);


ALTER TABLE public.permissions OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_id_seq OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- Name: remarks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.remarks (
    id bigint NOT NULL,
    title text,
    description text,
    file character varying(255) NOT NULL,
    status smallint DEFAULT '0'::smallint NOT NULL,
    creator_id integer,
    answer_user text,
    answer_text text,
    answer_file character varying(255),
    created_date date NOT NULL,
    answered_date date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    created_by integer,
    updated_by integer,
    deleted_by integer
);


ALTER TABLE public.remarks OWNER TO postgres;

--
-- Name: remarks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.remarks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.remarks_id_seq OWNER TO postgres;

--
-- Name: remarks_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.remarks_id_seq OWNED BY public.remarks.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    username character varying(255) NOT NULL,
    firstname character varying(255),
    surname character varying(255),
    patronymic character varying(255),
    birth_date date,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    status smallint DEFAULT '1'::smallint NOT NULL,
    phone character varying(20),
    role character varying(255) NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    verify_code character varying(255),
    profile_img character varying(255),
    verify_code_expire timestamp(0) without time zone,
    show_password character varying(255),
    device_token character varying(255),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    permission_group_id integer,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['user'::character varying, 'librarian'::character varying, 'admin'::character varying, 'moderator'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: i18n_sources id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.i18n_sources ALTER COLUMN id SET DEFAULT nextval('public.i18n_sources_id_seq'::regclass);


--
-- Name: media id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media ALTER COLUMN id SET DEFAULT nextval('public.media_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: news id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);


--
-- Name: permission_groups id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_groups ALTER COLUMN id SET DEFAULT nextval('public.permission_groups_id_seq'::regclass);


--
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- Name: remarks id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.remarks ALTER COLUMN id SET DEFAULT nextval('public.remarks_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: configs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.configs (id, value) FROM stdin;
grid-pagination-limit	15
max-upload-file-size	4096000
max-upload-image-size	1024000
\.


--
-- Data for Name: i18n_sources; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.i18n_sources (id, category, key) FROM stdin;
\.


--
-- Data for Name: i18n_translations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.i18n_translations (source_id, language, message) FROM stdin;
\.


--
-- Data for Name: languages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.languages (code, name) FROM stdin;
oz	O'zbekcha
\.


--
-- Data for Name: media; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.media (id, disk, directory, filename, extension, mime_type, aggregate_type, size, created_at, updated_at, variant_name, original_media_id) FROM stdin;
1	public	News/1/images	1704947324	jpg	image/jpeg	image	2083432	2024-01-11 09:28:44	2024-01-11 09:28:53	\N	\N
2	public	file_editor/file	1704948089	zip	application/zip	archive	32406	2024-01-11 09:41:29	2024-01-11 09:41:29	\N	\N
3	public	Remark/1/files	1704948093	zip	application/zip	archive	32406	2024-01-11 09:41:33	2024-01-11 09:44:30	\N	\N
4	public	Remark/1/files	1704948095	zip	application/zip	archive	32406	2024-01-11 09:41:35	2024-01-11 09:44:30	\N	\N
\.


--
-- Data for Name: mediables; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mediables (media_id, mediable_type, mediable_id, tag, "order") FROM stdin;
1	App\\Models\\Crm\\News	1	news_image	1
3	App\\Models\\Crm\\Remark	2	remark_file	1
4	App\\Models\\Crm\\Remark	2	remark_answer_file	1
3	App\\Models\\Crm\\Remark	1	remark_file	1
4	App\\Models\\Crm\\Remark	1	remark_answer_file	1
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_06_06_104439_create_languages_table	1
2	2014_10_12_000000_create_users_table	1
3	2016_06_27_000000_create_mediable_tables	1
4	2020_10_12_000000_add_variants_to_media	1
5	2021_06_06_103600_create_configs_table	1
6	2021_06_06_115520_create_i18n_sources_table	1
7	2021_06_06_120521_create_i18n_translations_table	1
8	2021_06_07_120829_create_permissions_table	1
9	2021_06_07_120912_create_permission_groups_table	1
10	2021_06_07_120944_create_permission_group_permissions_table	1
11	2021_06_07_121320_add_permission_group_id_to_users_table	1
12	2023_12_26_174018_create_news_table	1
13	2023_12_26_174902_create_news_translations_table	1
14	2024_01_09_132631_create_remarks_table	1
\.


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news (id, img, publish_at, type, status, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
1	1	2023-01-09	news	1	2024-01-11 09:28:53	2024-01-11 09:28:53	\N	2	\N	\N
\.


--
-- Data for Name: news_translations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news_translations (news_id, language, title, short_description, description, created_at, updated_at) FROM stdin;
1	oz	sasasa	djhksjjdjsdhas	dsasdss	2024-01-11 09:28:53	2024-01-11 09:28:53
\.


--
-- Data for Name: permission_group_permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permission_group_permissions (permission_group_id, permission_id) FROM stdin;
1	29
1	30
1	31
1	32
1	33
1	34
1	36
1	37
1	38
1	39
1	40
\.


--
-- Data for Name: permission_groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permission_groups (id, name, created_at, updated_at) FROM stdin;
1	admin	2024-01-11 09:24:08	2024-01-11 09:24:11
2	user	2024-01-11 09:24:21	2024-01-11 09:24:24
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissions (id, name, display_name, parent_id) FROM stdin;
1	crm_configs	Sozlash ma'lumotlari	\N
2	crm_config_index	Sozlash ma'lumotlari ro'yxati	1
3	crm_config_store	Sozlash ma'lumotini saqlash	1
4	crm_config_update	Sozlash ma'lumotini o'zgartirish	1
5	crm_config_show	Sozlash ma'lumotlar	1
6	crm_i18n_sources	Tillar	\N
7	crm_i18n_index	Tillar ro'yxati	6
8	crm_i18n_store	Tilni saqlash	6
9	crm_i18n_update	Tilni tahrirlash	6
10	crm_i18n_show	Tilni ko'rish	6
11	crm_i18n_destroy	Tilni o'chirish	6
12	crm_permission_groups	Huquqlar	\N
13	crm_permission_group_index	Huquq guruhi	12
14	crm_permission_group_store	Huquq guruhini qo'shish	12
15	crm_permission_group_update	Huquq guruhini tahrirlash	12
16	crm_permission_group_show	Huquq guruhini ko'rish	12
17	crm_permission_group_destroy	Huquq guruhini o'chirish	12
18	crm_admin	Adminlar ro'yxati (paginationsiz)	\N
19	crm_admin_index	Adminlar ro'yxati	18
20	crm_admin_store	Admin ma'lumotini qo'shish	18
21	crm_admin_update	Admin ma'lumotini tahrirlash	18
22	crm_admin_show	Admin ma'lumotini ko'rish	18
23	crm_admin_destroy	Admin ma'lumotini o'chirish	18
24	crm_users	Admin uchun barcha foydalanuvchilar	\N
25	crm_users_index	Admin uchun barcha foydalanuvchilar ro'yxati	24
26	crm_update_role	Foydalanuvchi ma'lumotini almashtirish	24
27	crm_users_show	Foydalanuvchi ma'lumoti	24
28	news	Yangiliklar	\N
29	crm_news_index	Yangiliklar ro'yxati	28
30	crm_news_store	Yangillikni saqlash	28
31	crm_news_update	Yangilikni tahrirlash	28
32	crm_news_show	Mamlakatni ko'rish	28
33	crm_news_destroy	Mamlakatni o'chirish	28
34	crm_news_update_status	Yangilikni o'chirish	28
35	remark	Remarklar	\N
36	crm_remark_index	Remarklar ro'yxati	35
37	crm_remark_store	Remarklarni saqlash	35
38	crm_remark_update	Remarklarni tahrirlash	35
39	crm_remark_show	Remarklarni ko'rish	35
40	crm_remark_destroy	Remarklarni o'chirish	35
\.


--
-- Data for Name: remarks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.remarks (id, title, description, file, status, creator_id, answer_user, answer_text, answer_file, created_date, answered_date, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
2	sasasa	sasasa	3	1	1	sasasasa	sasasas	4	2023-01-09	2023-01-09	2024-01-11 09:41:47	2024-01-11 09:41:47	\N	\N	\N	\N
1	seven qatori	sasasa description	3	1	1	sasasasa answer	sasasas answer text	4	2023-01-09	2023-01-09	2024-01-11 09:39:21	2024-01-11 09:44:37	\N	\N	\N	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, firstname, surname, patronymic, birth_date, email_verified_at, password, status, phone, role, created_by, updated_by, deleted_by, verify_code, profile_img, verify_code_expire, show_password, device_token, remember_token, created_at, updated_at, deleted_at, permission_group_id) FROM stdin;
2	nusratakhmadjonovich1@gmail.com	Nusrat	Tuykhulov	\N	1997-01-09	\N	$2y$10$xEqzXExKP.96RNB1xDunSuy6F/sgzZpeSYCE3LfTMAQxU.eWBPJ..	1	\N	admin	\N	\N	\N	8SYpwYRQzynHmdPdiWYr7zr3vUd8Hi	\N	2024-01-11 09:24:56	Wert123$	\N	\N	2024-01-11 09:24:57	2024-01-11 09:24:57	\N	1
\.


--
-- Name: i18n_sources_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.i18n_sources_id_seq', 1, false);


--
-- Name: media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.media_id_seq', 4, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 14, true);


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.news_id_seq', 1, true);


--
-- Name: permission_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permission_groups_id_seq', 2, true);


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permissions_id_seq', 40, true);


--
-- Name: remarks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.remarks_id_seq', 2, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- Name: configs configs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.configs
    ADD CONSTRAINT configs_pkey PRIMARY KEY (id);


--
-- Name: i18n_sources i18n_sources_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.i18n_sources
    ADD CONSTRAINT i18n_sources_pkey PRIMARY KEY (id);


--
-- Name: i18n_translations i18n_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.i18n_translations
    ADD CONSTRAINT i18n_translations_pkey PRIMARY KEY (source_id, language);


--
-- Name: languages languages_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.languages
    ADD CONSTRAINT languages_code_unique UNIQUE (code);


--
-- Name: languages languages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.languages
    ADD CONSTRAINT languages_pkey PRIMARY KEY (code);


--
-- Name: media media_disk_directory_filename_extension_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_disk_directory_filename_extension_unique UNIQUE (disk, directory, filename, extension);


--
-- Name: media media_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_pkey PRIMARY KEY (id);


--
-- Name: mediables mediables_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mediables
    ADD CONSTRAINT mediables_pkey PRIMARY KEY (media_id, mediable_type, mediable_id, tag);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: news news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: news_translations news_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news_translations
    ADD CONSTRAINT news_translations_pkey PRIMARY KEY (news_id, language);


--
-- Name: permission_group_permissions permission_group_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_group_permissions
    ADD CONSTRAINT permission_group_permissions_pkey PRIMARY KEY (permission_group_id, permission_id);


--
-- Name: permission_groups permission_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_groups
    ADD CONSTRAINT permission_groups_pkey PRIMARY KEY (id);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- Name: remarks remarks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.remarks
    ADD CONSTRAINT remarks_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: media_aggregate_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX media_aggregate_type_index ON public.media USING btree (aggregate_type);


--
-- Name: mediables_mediable_id_mediable_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX mediables_mediable_id_mediable_type_index ON public.mediables USING btree (mediable_id, mediable_type);


--
-- Name: mediables_order_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX mediables_order_index ON public.mediables USING btree ("order");


--
-- Name: mediables_tag_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX mediables_tag_index ON public.mediables USING btree (tag);


--
-- Name: i18n_translations i18n_translations_language_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.i18n_translations
    ADD CONSTRAINT i18n_translations_language_foreign FOREIGN KEY (language) REFERENCES public.languages(code);


--
-- Name: i18n_translations i18n_translations_source_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.i18n_translations
    ADD CONSTRAINT i18n_translations_source_id_foreign FOREIGN KEY (source_id) REFERENCES public.i18n_sources(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: mediables mediables_media_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mediables
    ADD CONSTRAINT mediables_media_id_foreign FOREIGN KEY (media_id) REFERENCES public.media(id) ON DELETE CASCADE;


--
-- Name: news_translations news_translations_language_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news_translations
    ADD CONSTRAINT news_translations_language_foreign FOREIGN KEY (language) REFERENCES public.languages(code);


--
-- Name: news_translations news_translations_news_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news_translations
    ADD CONSTRAINT news_translations_news_id_foreign FOREIGN KEY (news_id) REFERENCES public.news(id);


--
-- Name: media original_media_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT original_media_id FOREIGN KEY (original_media_id) REFERENCES public.media(id) ON DELETE SET NULL;


--
-- Name: permission_group_permissions permission_group_permissions_permission_group_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_group_permissions
    ADD CONSTRAINT permission_group_permissions_permission_group_id_foreign FOREIGN KEY (permission_group_id) REFERENCES public.permission_groups(id);


--
-- Name: permission_group_permissions permission_group_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_group_permissions
    ADD CONSTRAINT permission_group_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id);


--
-- Name: users users_permission_group_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_permission_group_id_foreign FOREIGN KEY (permission_group_id) REFERENCES public.permission_groups(id);


--
-- PostgreSQL database dump complete
--

