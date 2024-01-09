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
-- Name: countries; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.countries (
    id bigint NOT NULL,
    status smallint DEFAULT '1'::smallint NOT NULL,
    code character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    created_by integer,
    updated_by integer,
    deleted_by integer
);


ALTER TABLE public.countries OWNER TO postgres;

--
-- Name: countries_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.countries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.countries_id_seq OWNER TO postgres;

--
-- Name: countries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.countries_id_seq OWNED BY public.countries.id;


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
    message character varying(255) NOT NULL,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.i18n_translations OWNER TO postgres;

--
-- Name: landing_positions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.landing_positions (
    id bigint NOT NULL,
    status smallint DEFAULT '1'::smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    created_by integer,
    updated_by integer,
    deleted_by integer
);


ALTER TABLE public.landing_positions OWNER TO postgres;

--
-- Name: landing_positions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.landing_positions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.landing_positions_id_seq OWNER TO postgres;

--
-- Name: landing_positions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.landing_positions_id_seq OWNED BY public.landing_positions.id;


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
    CONSTRAINT news_type_check CHECK (((type)::text = ANY (ARRAY[('announce'::character varying)::text, ('news'::character varying)::text])))
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
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    username character varying(255) NOT NULL,
    firstname character varying(255),
    surname character varying(255),
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
    bio text,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY (ARRAY[('user'::character varying)::text, ('librarian'::character varying)::text, ('admin'::character varying)::text, ('moderator'::character varying)::text])))
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
-- Name: countries id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.countries ALTER COLUMN id SET DEFAULT nextval('public.countries_id_seq'::regclass);


--
-- Name: i18n_sources id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.i18n_sources ALTER COLUMN id SET DEFAULT nextval('public.i18n_sources_id_seq'::regclass);


--
-- Name: landing_positions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.landing_positions ALTER COLUMN id SET DEFAULT nextval('public.landing_positions_id_seq'::regclass);


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
-- Data for Name: countries; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.countries (id, status, code, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
\.


--
-- Data for Name: i18n_sources; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.i18n_sources (id, category, key) FROM stdin;
\.


--
-- Data for Name: i18n_translations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.i18n_translations (source_id, language, message, deleted_at) FROM stdin;
\.


--
-- Data for Name: landing_positions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.landing_positions (id, status, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
\.


--
-- Data for Name: languages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.languages (code, name) FROM stdin;
oz	Uzbek
\.


--
-- Data for Name: media; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.media (id, disk, directory, filename, extension, mime_type, aggregate_type, size, created_at, updated_at, variant_name, original_media_id) FROM stdin;
1	public	assets	1703652262	png	image/png	image	11574	2023-12-27 09:44:22	2023-12-27 09:44:22	\N	\N
3	public	assets	1704236677	jpg	image/jpeg	image	581177	2024-01-03 04:04:37	2024-01-03 04:04:37	\N	\N
4	public	assets	1704236691	jpg	image/jpeg	image	1172254	2024-01-03 04:04:52	2024-01-03 04:04:52	\N	\N
2	public	News/22/images	1703652268	png	image/png	image	11574	2023-12-27 09:44:28	2024-01-08 00:10:05	\N	\N
\.


--
-- Data for Name: mediables; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mediables (media_id, mediable_type, mediable_id, tag, "order") FROM stdin;
2	App\\Models\\Crm\\News	2	news_image	1
2	App\\Models\\Crm\\News	3	news_image	1
2	App\\Models\\Crm\\News	4	news_image	1
2	App\\Models\\Crm\\News	5	news_image	1
2	App\\Models\\Crm\\News	6	news_image	1
2	App\\Models\\Crm\\News	7	news_image	1
2	App\\Models\\Crm\\News	5	post_image	1
2	App\\Models\\Crm\\News	9	news_image	1
2	App\\Models\\Crm\\News	8	news_image	1
2	App\\Models\\Crm\\News	10	news_image	1
2	App\\Models\\Crm\\News	11	news_image	1
2	App\\Models\\Crm\\News	12	news_image	1
2	App\\Models\\Crm\\News	13	news_image	1
2	App\\Models\\Crm\\News	14	news_image	1
2	App\\Models\\Crm\\News	15	news_image	1
2	App\\Models\\Crm\\News	16	news_image	1
2	App\\Models\\Crm\\News	17	news_image	1
2	App\\Models\\Crm\\News	18	news_image	1
2	App\\Models\\Crm\\News	19	news_image	1
2	App\\Models\\Crm\\News	20	news_image	1
2	App\\Models\\Crm\\News	21	news_image	1
2	App\\Models\\Crm\\News	22	news_image	1
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_06_06_104439_create_languages_table	1
2	2014_10_12_000000_create_users_table	1
3	2016_06_27_000000_create_mediable_tables	1
4	2020_10_12_000000_add_variants_to_media	1
5	2021_05_17_173103_create_universities_table	1
6	2021_05_26_212553_create_university_translations_table	1
7	2021_06_06_103600_create_configs_table	1
8	2021_06_06_115520_create_i18n_sources_table	1
9	2021_06_06_120521_create_i18n_translations_table	1
10	2021_06_07_120829_create_permissions_table	1
11	2021_06_07_120912_create_permission_groups_table	1
12	2021_06_07_120944_create_permission_group_permissions_table	1
13	2021_06_07_121320_add_permission_group_id_to_users_table	1
14	2021_06_07_172933_create_posts_table	1
15	2021_06_07_173017_create_post_translations_table	1
16	2022_02_27_225839_create_resource_types_table	1
17	2022_02_27_225918_create_resource_type_translations_table	1
18	2022_03_02_231653_create_resource_fields_table	1
19	2022_03_02_231848_create_resource_fields_translations_table	1
20	2022_03_03_092701_create_resource_categories_table	1
21	2022_03_03_092913_create_resource_categories_translations_table	1
22	2022_03_03_104247_create_resource_languages_table	1
23	2022_03_03_104546_create_resource_language_translations_table	1
24	2022_03_03_112045_create_countries_table	1
25	2022_03_03_112422_create_country_translations_table	1
26	2022_03_03_121851_create_regions_table	1
27	2022_03_03_122046_create_region_translations_table	1
28	2022_03_15_222500_create_user_universities_table	1
29	2022_03_16_230140_create_publisher_resources_table	1
30	2022_03_19_115530_create_resource_genres_table	1
31	2022_03_19_115831_create_resource_genre_translations_table	1
32	2022_04_04_212331_create_landing_positions_table	1
33	2022_04_04_212549_create_landing_position_translations_table	1
34	2022_04_04_230351_create_resource_landing_positions_table	1
35	2022_04_06_111453_create_journal_types_table	1
36	2022_04_06_111710_create_journal_type_translations_table	1
37	2022_04_06_120108_create_journals_table	1
38	2022_04_06_120150_create_journal_translations_table	1
39	2022_04_07_223942_create_resource_modifiers_table	1
40	2022_04_07_223942_create_resource_universities_table	1
41	2022_04_07_223942_create_resource_users_table	1
42	2022_04_07_224628_create_resource_modifier_translations_table	1
43	2022_04_08_201310_add_count_view_to_publisher_resources	1
44	2022_04_09_003210_add_count_download_to_publisher_resources	1
45	2022_04_09_155525_add_resource_modifier_id_to_publisher_resources	1
46	2022_04_09_172354_add_unique_key_category_to_i18n_sources_table	1
47	2022_04_20_202206_add_bio_to_users_table	1
48	2022_04_24_195358_create_publisher_resource_statuses_table	1
49	2022_04_24_195943_add_reject_to_publisher_resources_table	1
50	2022_05_01_040625_add_phone_to_universities	1
51	2022_05_01_041541_add_short_name_to_university_translations	1
52	2022_05_01_231809_add_university_id_to_journals_table	1
53	2022_05_07_105754_add_soft_deletes_to_university_translations_table	1
54	2022_05_09_211045_create_resource_intendeds_table	1
55	2022_05_09_215504_create_resource_intended_translations_table	1
56	2022_05_15_151417_add_author_to_users_table	1
57	2022_06_06_200647_create_university_types_table	1
58	2022_06_06_200935_create_university_type_translations_table	1
59	2022_06_06_212533_add_university_type_id_to_universities_table	1
60	2022_07_27_123058_add_optional_to_users	1
61	2022_07_29_135108_create_access_other_resources_table	1
62	2022_07_29_203339_add_doi_article_to_publisher_resources	1
63	2022_07_30_213740_add_count_view_to_journals	1
64	2023_12_26_174018_create_news_table	2
65	2023_12_26_174902_create_news_translations_table	2
\.


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news (id, img, publish_at, type, status, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
2	2	2023-01-09	news	1	2023-12-27 09:44:54	2023-12-27 09:44:54	\N	5	\N	\N
3	2	2023-01-09	news	1	2023-12-27 09:47:50	2023-12-27 09:47:50	\N	5	\N	\N
4	2	2023-01-09	news	1	2023-12-27 09:48:40	2023-12-27 09:48:40	\N	5	\N	\N
6	2	2023-01-09	news	1	2023-12-27 10:14:39	2023-12-27 10:48:08	2023-12-27 10:48:08	5	\N	5
5	2	2023-01-06	news	1	2023-12-27 09:49:45	2023-12-27 10:48:54	\N	5	5	\N
9	2	2023-01-09	news	1	2023-12-27 11:33:11	2023-12-27 11:33:11	\N	5	\N	\N
8	2	2023-01-09	news	2	2023-12-27 11:00:55	2023-12-27 11:33:32	\N	5	5	\N
10	2	2023-01-09	news	1	2023-12-27 14:17:07	2023-12-27 14:17:07	\N	5	\N	\N
11	2	2023-01-09	news	1	2023-12-27 14:24:45	2023-12-27 14:24:45	\N	5	\N	\N
7	2	2023-01-09	news	1	2023-12-27 10:45:52	2023-12-27 14:24:57	\N	5	5	\N
12	2	2023-01-09	news	1	2023-12-27 15:08:23	2023-12-27 15:08:23	\N	5	\N	\N
13	2	2023-01-09	announce	1	2023-12-27 15:08:34	2023-12-27 15:08:34	\N	5	\N	\N
14	2	2023-01-09	announce	1	2023-12-27 15:08:36	2023-12-27 15:08:36	\N	5	\N	\N
15	2	2023-01-09	news	1	2024-01-07 22:56:57	2024-01-07 22:56:57	\N	5	\N	\N
16	2	2023-01-09	news	1	2024-01-07 22:57:35	2024-01-07 22:57:35	\N	5	\N	\N
17	2	2023-01-09	news	1	2024-01-08 00:08:02	2024-01-08 00:08:02	\N	5	\N	\N
18	2	2023-01-09	news	1	2024-01-08 00:08:04	2024-01-08 00:08:04	\N	5	\N	\N
19	2	2023-01-09	news	1	2024-01-08 00:08:17	2024-01-08 00:08:17	\N	5	\N	\N
20	2	2023-01-09	news	1	2024-01-08 00:08:47	2024-01-08 00:08:47	\N	5	\N	\N
21	2	2023-01-09	news	1	2024-01-08 00:09:04	2024-01-08 00:09:04	\N	5	\N	\N
22	2	2023-01-09	news	1	2024-01-08 00:10:05	2024-01-08 00:10:05	\N	5	\N	\N
\.


--
-- Data for Name: news_translations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news_translations (news_id, language, title, short_description, description, created_at, updated_at) FROM stdin;
6	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 10:14:39	2023-12-27 10:14:39
7	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 10:45:53	2023-12-27 10:45:53
5	oz	Salomjon	Lorem ipsum	dsasdss	2023-12-27 09:49:45	2023-12-27 10:48:55
9	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 11:33:12	2023-12-27 11:33:12
8	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 11:00:55	2023-12-27 11:33:32
10	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 14:17:07	2023-12-27 14:17:07
11	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 14:24:45	2023-12-27 14:24:45
12	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 15:08:23	2023-12-27 15:08:23
13	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 15:08:34	2023-12-27 15:08:34
14	oz	sasasa	djhksjjdjsdhas	dsasdss	2023-12-27 15:08:36	2023-12-27 15:08:36
15	oz	sasasa	djhksjjdjsdhas	dsasdss	2024-01-07 22:56:57	2024-01-07 22:56:57
16	oz	sasasa	djhksjjdjsdhas	dsasdss	2024-01-07 22:57:35	2024-01-07 22:57:35
17	oz	sasasa	djhksjjdjsdhas	dsasdss	2024-01-08 00:08:02	2024-01-08 00:08:02
18	oz	sasasa	djhksjjdjsdhas	dsasdss	2024-01-08 00:08:04	2024-01-08 00:08:04
19	oz	sasasa 11	djhksjjdjsdhas 11	dsasdss 11	2024-01-08 00:08:17	2024-01-08 00:08:17
20	oz	sasasa 11	djhksjjdjsdhas 11	dsasdss 11	2024-01-08 00:08:47	2024-01-08 00:08:47
21	oz	sasasa 11	djhksjjdjsdhas 11	dsasdss 11	2024-01-08 00:09:04	2024-01-08 00:09:04
22	oz	sasasa 11	djhksjjdjsdhas 11	dsasdss 11	2024-01-08 00:10:05	2024-01-08 00:10:05
\.


--
-- Data for Name: permission_group_permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permission_group_permissions (permission_group_id, permission_id) FROM stdin;
1	113
1	115
1	116
1	117
1	118
1	114
\.


--
-- Data for Name: permission_groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permission_groups (id, name, created_at, updated_at) FROM stdin;
1	admin	\N	\N
2	user	\N	\N
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissions (id, name, display_name, parent_id) FROM stdin;
112	crm_news	Yangiliklar qo'shish	\N
113	crm_news_index	Yangiliklar Ro'yxati	112
114	crm_news_store	Yangilik Qo'shish	112
115	crm_news_update	Yangilikni tahrirlash	112
116	crm_news_show	Yangiliklarni ko'rish	112
117	crm_news_destroy	Yangiliklarni o'chirish	112
118	crm_news_update_status	Yangilik statusini o'zgartirish	112
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, firstname, surname, birth_date, email_verified_at, password, status, phone, role, created_by, updated_by, deleted_by, verify_code, profile_img, verify_code_expire, show_password, device_token, remember_token, created_at, updated_at, deleted_at, permission_group_id, bio) FROM stdin;
6	nusratakhmadjonovich@gmail.com	Nusrat	Tuykhulov	1997-01-09	\N	$2y$10$sIdW6L8XdprX.JwLleZTs.aHREbaMI1/eM/TZs.lpXJhjtBqTydsG	-1	\N	user	\N	\N	\N	R874JbMeAndvpVZGovRqzn844KvjWp	\N	2023-12-26 17:33:37	Wert123$	\N	\N	2023-12-26 17:33:37	2023-12-26 17:33:37	\N	2	\N
7	nusratakhmadjonovich44@gmail.com	Nusrat44	Tuykhulov44	1997-09-09	\N	$2y$10$eDai3m1pV1iYSvUv5RkCDehC7ZvCt7HmLKfE0RJNAnQ6NnuqucgAy	-1	\N	user	\N	\N	\N	bZlLHGxhZJNw9wdtyjO5QNFME1z64V	\N	2023-12-26 17:34:28	Wert123$aa	\N	\N	2023-12-26 17:34:29	2023-12-26 17:34:29	\N	2	\N
8	nusratakhmadjonovich55@gmail.com	Nusrat55	Tuykhulov55	1997-07-09	\N	$2y$10$Xxfko63hviwtCLtUWzcbg.hgqK3JW1o8VgPHsX6lfwLzPV84OEJGm	-1	\N	user	\N	\N	\N	0MX03kHppHdkLL9jd5w9nR0YDyW5Ew	\N	2023-12-26 17:35:10	Wert12$aa	\N	\N	2023-12-26 17:35:10	2023-12-26 17:35:10	\N	2	\N
5	nusratakhmadjonovich1@gmail.com	Nusrat	Tuykhulov	1997-01-09	\N	$2y$10$P0dX6V4ZQ3pKnh3PwRjNLusDEI.rZafN4WnJg4tAc/t7.yMtnSHEW	1	\N	admin	\N	\N	\N	vJOCzgtTmVtGj0G2WtactP8IjBjGsJ	\N	2023-12-26 17:32:24	Wert123$	\N	\N	2023-12-26 17:32:24	2023-12-26 17:32:24	\N	1	\N
9	nusratakhmadjonov@gmail.com	Nusrat55	Tuykhulov55	1997-07-09	\N	$2y$10$Z8n/k5prjrtXAgaRYlfKhOh//saKt5Y6cO6GdtmqCkfiZTWJjocLa	-1	\N	user	\N	\N	\N	J8qEeUgMGRBay1Xk66aK4Jt42I11Ny	\N	2023-12-27 12:18:07	Wert12$aa	\N	\N	2023-12-27 12:18:07	2023-12-27 12:18:07	\N	2	\N
10	nusratakhmadjonovich14545@gmail.com	Nusrat	Tuykhulov	1997-01-09	\N	$2y$10$1e4wDp0ruqoENZ8DnYfjduJ6VVobp5BqNy.BtHTDTKiRcg7Yv4ypK	-1	\N	user	\N	\N	\N	DGIVwUHJijTavoZGP5KhT3tO6iMmaA	\N	2024-01-03 04:01:42	Wert123$	\N	\N	2024-01-03 04:01:42	2024-01-03 04:01:42	\N	2	\N
\.


--
-- Name: countries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.countries_id_seq', 1, false);


--
-- Name: i18n_sources_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.i18n_sources_id_seq', 1, false);


--
-- Name: landing_positions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.landing_positions_id_seq', 1, false);


--
-- Name: media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.media_id_seq', 4, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 65, true);


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.news_id_seq', 22, true);


--
-- Name: permission_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permission_groups_id_seq', 2, true);


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permissions_id_seq', 118, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 10, true);


--
-- Name: configs configs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.configs
    ADD CONSTRAINT configs_pkey PRIMARY KEY (id);


--
-- Name: countries countries_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.countries
    ADD CONSTRAINT countries_pkey PRIMARY KEY (id);


--
-- Name: i18n_sources i18n_sources_key_category_first_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.i18n_sources
    ADD CONSTRAINT i18n_sources_key_category_first_unique UNIQUE (key, category);


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
-- Name: landing_positions landing_positions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.landing_positions
    ADD CONSTRAINT landing_positions_pkey PRIMARY KEY (id);


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

