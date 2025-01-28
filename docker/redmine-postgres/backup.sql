--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2 (Debian 17.2-1.pgdg120+1)
-- Dumped by pg_dump version 17.2 (Debian 17.2-1.pgdg120+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
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
-- Name: ar_internal_metadata; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ar_internal_metadata (
    key character varying NOT NULL,
    value character varying,
    created_at timestamp(6) without time zone NOT NULL,
    updated_at timestamp(6) without time zone NOT NULL
);


ALTER TABLE public.ar_internal_metadata OWNER TO postgres;

--
-- Name: attachments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attachments (
    id integer NOT NULL,
    container_id integer,
    container_type character varying(30),
    filename character varying DEFAULT ''::character varying NOT NULL,
    disk_filename character varying DEFAULT ''::character varying NOT NULL,
    filesize bigint DEFAULT 0 NOT NULL,
    content_type character varying DEFAULT ''::character varying,
    digest character varying(64) DEFAULT ''::character varying NOT NULL,
    downloads integer DEFAULT 0 NOT NULL,
    author_id integer DEFAULT 0 NOT NULL,
    created_on timestamp without time zone,
    description character varying,
    disk_directory character varying
);


ALTER TABLE public.attachments OWNER TO postgres;

--
-- Name: attachments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.attachments_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.attachments_id_seq OWNER TO postgres;

--
-- Name: attachments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.attachments_id_seq OWNED BY public.attachments.id;


--
-- Name: auth_sources; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auth_sources (
    id integer NOT NULL,
    type character varying(30) DEFAULT ''::character varying NOT NULL,
    name character varying(60) DEFAULT ''::character varying NOT NULL,
    host character varying(60),
    port integer,
    account character varying,
    account_password character varying DEFAULT ''::character varying,
    base_dn character varying(255),
    attr_login character varying(30),
    attr_firstname character varying(30),
    attr_lastname character varying(30),
    attr_mail character varying(30),
    onthefly_register boolean DEFAULT false NOT NULL,
    tls boolean DEFAULT false NOT NULL,
    filter text,
    timeout integer,
    verify_peer boolean DEFAULT true NOT NULL
);


ALTER TABLE public.auth_sources OWNER TO postgres;

--
-- Name: auth_sources_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auth_sources_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auth_sources_id_seq OWNER TO postgres;

--
-- Name: auth_sources_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auth_sources_id_seq OWNED BY public.auth_sources.id;


--
-- Name: boards; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.boards (
    id integer NOT NULL,
    project_id integer NOT NULL,
    name character varying DEFAULT ''::character varying NOT NULL,
    description character varying,
    "position" integer,
    topics_count integer DEFAULT 0 NOT NULL,
    messages_count integer DEFAULT 0 NOT NULL,
    last_message_id integer,
    parent_id integer
);


ALTER TABLE public.boards OWNER TO postgres;

--
-- Name: boards_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.boards_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.boards_id_seq OWNER TO postgres;

--
-- Name: boards_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.boards_id_seq OWNED BY public.boards.id;


--
-- Name: changes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.changes (
    id integer NOT NULL,
    changeset_id integer NOT NULL,
    action character varying(1) DEFAULT ''::character varying NOT NULL,
    path text NOT NULL,
    from_path text,
    from_revision character varying,
    revision character varying,
    branch character varying
);


ALTER TABLE public.changes OWNER TO postgres;

--
-- Name: changes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.changes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.changes_id_seq OWNER TO postgres;

--
-- Name: changes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.changes_id_seq OWNED BY public.changes.id;


--
-- Name: changeset_parents; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.changeset_parents (
    changeset_id integer NOT NULL,
    parent_id integer NOT NULL
);


ALTER TABLE public.changeset_parents OWNER TO postgres;

--
-- Name: changesets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.changesets (
    id integer NOT NULL,
    repository_id integer NOT NULL,
    revision character varying NOT NULL,
    committer character varying,
    committed_on timestamp without time zone NOT NULL,
    comments text,
    commit_date date,
    scmid character varying,
    user_id integer
);


ALTER TABLE public.changesets OWNER TO postgres;

--
-- Name: changesets_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.changesets_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.changesets_id_seq OWNER TO postgres;

--
-- Name: changesets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.changesets_id_seq OWNED BY public.changesets.id;


--
-- Name: changesets_issues; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.changesets_issues (
    changeset_id integer NOT NULL,
    issue_id integer NOT NULL
);


ALTER TABLE public.changesets_issues OWNER TO postgres;

--
-- Name: comments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.comments (
    id integer NOT NULL,
    commented_type character varying(30) DEFAULT ''::character varying NOT NULL,
    commented_id integer DEFAULT 0 NOT NULL,
    author_id integer DEFAULT 0 NOT NULL,
    content text,
    created_on timestamp without time zone NOT NULL,
    updated_on timestamp without time zone NOT NULL
);


ALTER TABLE public.comments OWNER TO postgres;

--
-- Name: comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.comments_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.comments_id_seq OWNER TO postgres;

--
-- Name: comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.comments_id_seq OWNED BY public.comments.id;


--
-- Name: custom_field_enumerations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.custom_field_enumerations (
    id integer NOT NULL,
    custom_field_id integer NOT NULL,
    name character varying NOT NULL,
    active boolean DEFAULT true NOT NULL,
    "position" integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.custom_field_enumerations OWNER TO postgres;

--
-- Name: custom_field_enumerations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.custom_field_enumerations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.custom_field_enumerations_id_seq OWNER TO postgres;

--
-- Name: custom_field_enumerations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.custom_field_enumerations_id_seq OWNED BY public.custom_field_enumerations.id;


--
-- Name: custom_fields; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.custom_fields (
    id integer NOT NULL,
    type character varying(30) DEFAULT ''::character varying NOT NULL,
    name character varying(30) DEFAULT ''::character varying NOT NULL,
    field_format character varying(30) DEFAULT ''::character varying NOT NULL,
    possible_values text,
    regexp character varying DEFAULT ''::character varying,
    min_length integer,
    max_length integer,
    is_required boolean DEFAULT false NOT NULL,
    is_for_all boolean DEFAULT false NOT NULL,
    is_filter boolean DEFAULT false NOT NULL,
    "position" integer,
    searchable boolean DEFAULT false,
    default_value text,
    editable boolean DEFAULT true,
    visible boolean DEFAULT true NOT NULL,
    multiple boolean DEFAULT false,
    format_store text,
    description text
);


ALTER TABLE public.custom_fields OWNER TO postgres;

--
-- Name: custom_fields_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.custom_fields_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.custom_fields_id_seq OWNER TO postgres;

--
-- Name: custom_fields_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.custom_fields_id_seq OWNED BY public.custom_fields.id;


--
-- Name: custom_fields_projects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.custom_fields_projects (
    custom_field_id integer DEFAULT 0 NOT NULL,
    project_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.custom_fields_projects OWNER TO postgres;

--
-- Name: custom_fields_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.custom_fields_roles (
    custom_field_id integer NOT NULL,
    role_id integer NOT NULL
);


ALTER TABLE public.custom_fields_roles OWNER TO postgres;

--
-- Name: custom_fields_trackers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.custom_fields_trackers (
    custom_field_id integer DEFAULT 0 NOT NULL,
    tracker_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.custom_fields_trackers OWNER TO postgres;

--
-- Name: custom_values; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.custom_values (
    id integer NOT NULL,
    customized_type character varying(30) DEFAULT ''::character varying NOT NULL,
    customized_id integer DEFAULT 0 NOT NULL,
    custom_field_id integer DEFAULT 0 NOT NULL,
    value text
);


ALTER TABLE public.custom_values OWNER TO postgres;

--
-- Name: custom_values_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.custom_values_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.custom_values_id_seq OWNER TO postgres;

--
-- Name: custom_values_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.custom_values_id_seq OWNED BY public.custom_values.id;


--
-- Name: documents; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.documents (
    id integer NOT NULL,
    project_id integer DEFAULT 0 NOT NULL,
    category_id integer DEFAULT 0 NOT NULL,
    title character varying DEFAULT ''::character varying NOT NULL,
    description text,
    created_on timestamp without time zone
);


ALTER TABLE public.documents OWNER TO postgres;

--
-- Name: documents_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.documents_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.documents_id_seq OWNER TO postgres;

--
-- Name: documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.documents_id_seq OWNED BY public.documents.id;


--
-- Name: email_addresses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.email_addresses (
    id integer NOT NULL,
    user_id integer NOT NULL,
    address character varying NOT NULL,
    is_default boolean DEFAULT false NOT NULL,
    notify boolean DEFAULT true NOT NULL,
    created_on timestamp without time zone NOT NULL,
    updated_on timestamp without time zone NOT NULL
);


ALTER TABLE public.email_addresses OWNER TO postgres;

--
-- Name: email_addresses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.email_addresses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.email_addresses_id_seq OWNER TO postgres;

--
-- Name: email_addresses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.email_addresses_id_seq OWNED BY public.email_addresses.id;


--
-- Name: enabled_modules; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enabled_modules (
    id integer NOT NULL,
    project_id integer,
    name character varying NOT NULL
);


ALTER TABLE public.enabled_modules OWNER TO postgres;

--
-- Name: enabled_modules_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.enabled_modules_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.enabled_modules_id_seq OWNER TO postgres;

--
-- Name: enabled_modules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.enabled_modules_id_seq OWNED BY public.enabled_modules.id;


--
-- Name: enumerations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enumerations (
    id integer NOT NULL,
    name character varying(30) DEFAULT ''::character varying NOT NULL,
    "position" integer,
    is_default boolean DEFAULT false NOT NULL,
    type character varying,
    active boolean DEFAULT true NOT NULL,
    project_id integer,
    parent_id integer,
    position_name character varying(30)
);


ALTER TABLE public.enumerations OWNER TO postgres;

--
-- Name: enumerations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.enumerations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.enumerations_id_seq OWNER TO postgres;

--
-- Name: enumerations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.enumerations_id_seq OWNED BY public.enumerations.id;


--
-- Name: groups_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.groups_users (
    group_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.groups_users OWNER TO postgres;

--
-- Name: import_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.import_items (
    id integer NOT NULL,
    import_id integer NOT NULL,
    "position" integer NOT NULL,
    obj_id integer,
    message text,
    unique_id character varying
);


ALTER TABLE public.import_items OWNER TO postgres;

--
-- Name: import_items_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.import_items_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.import_items_id_seq OWNER TO postgres;

--
-- Name: import_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.import_items_id_seq OWNED BY public.import_items.id;


--
-- Name: imports; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.imports (
    id integer NOT NULL,
    type character varying,
    user_id integer NOT NULL,
    filename character varying,
    settings text,
    total_items integer,
    finished boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.imports OWNER TO postgres;

--
-- Name: imports_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.imports_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.imports_id_seq OWNER TO postgres;

--
-- Name: imports_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.imports_id_seq OWNED BY public.imports.id;


--
-- Name: issue_categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.issue_categories (
    id integer NOT NULL,
    project_id integer DEFAULT 0 NOT NULL,
    name character varying(60) DEFAULT ''::character varying NOT NULL,
    assigned_to_id integer
);


ALTER TABLE public.issue_categories OWNER TO postgres;

--
-- Name: issue_categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.issue_categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.issue_categories_id_seq OWNER TO postgres;

--
-- Name: issue_categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.issue_categories_id_seq OWNED BY public.issue_categories.id;


--
-- Name: issue_relations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.issue_relations (
    id integer NOT NULL,
    issue_from_id integer NOT NULL,
    issue_to_id integer NOT NULL,
    relation_type character varying DEFAULT ''::character varying NOT NULL,
    delay integer
);


ALTER TABLE public.issue_relations OWNER TO postgres;

--
-- Name: issue_relations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.issue_relations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.issue_relations_id_seq OWNER TO postgres;

--
-- Name: issue_relations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.issue_relations_id_seq OWNED BY public.issue_relations.id;


--
-- Name: issue_statuses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.issue_statuses (
    id integer NOT NULL,
    name character varying(30) DEFAULT ''::character varying NOT NULL,
    is_closed boolean DEFAULT false NOT NULL,
    "position" integer,
    default_done_ratio integer,
    description character varying
);


ALTER TABLE public.issue_statuses OWNER TO postgres;

--
-- Name: issue_statuses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.issue_statuses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.issue_statuses_id_seq OWNER TO postgres;

--
-- Name: issue_statuses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.issue_statuses_id_seq OWNED BY public.issue_statuses.id;


--
-- Name: issues; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.issues (
    id integer NOT NULL,
    tracker_id integer NOT NULL,
    project_id integer NOT NULL,
    subject character varying DEFAULT ''::character varying NOT NULL,
    description text,
    due_date date,
    category_id integer,
    status_id integer NOT NULL,
    assigned_to_id integer,
    priority_id integer NOT NULL,
    fixed_version_id integer,
    author_id integer NOT NULL,
    lock_version integer DEFAULT 0 NOT NULL,
    created_on timestamp without time zone,
    updated_on timestamp without time zone,
    start_date date,
    done_ratio integer DEFAULT 0 NOT NULL,
    estimated_hours double precision,
    parent_id integer,
    root_id integer,
    lft integer,
    rgt integer,
    is_private boolean DEFAULT false NOT NULL,
    closed_on timestamp without time zone
);


ALTER TABLE public.issues OWNER TO postgres;

--
-- Name: issues_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.issues_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.issues_id_seq OWNER TO postgres;

--
-- Name: issues_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.issues_id_seq OWNED BY public.issues.id;


--
-- Name: journal_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.journal_details (
    id integer NOT NULL,
    journal_id integer DEFAULT 0 NOT NULL,
    property character varying(30) DEFAULT ''::character varying NOT NULL,
    prop_key character varying(30) DEFAULT ''::character varying NOT NULL,
    old_value text,
    value text
);


ALTER TABLE public.journal_details OWNER TO postgres;

--
-- Name: journal_details_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.journal_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.journal_details_id_seq OWNER TO postgres;

--
-- Name: journal_details_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.journal_details_id_seq OWNED BY public.journal_details.id;


--
-- Name: journals; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.journals (
    id integer NOT NULL,
    journalized_id integer DEFAULT 0 NOT NULL,
    journalized_type character varying(30) DEFAULT ''::character varying NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    notes text,
    created_on timestamp without time zone NOT NULL,
    private_notes boolean DEFAULT false NOT NULL,
    updated_on timestamp without time zone,
    updated_by_id integer
);


ALTER TABLE public.journals OWNER TO postgres;

--
-- Name: journals_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.journals_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.journals_id_seq OWNER TO postgres;

--
-- Name: journals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.journals_id_seq OWNED BY public.journals.id;


--
-- Name: member_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.member_roles (
    id integer NOT NULL,
    member_id integer NOT NULL,
    role_id integer NOT NULL,
    inherited_from integer
);


ALTER TABLE public.member_roles OWNER TO postgres;

--
-- Name: member_roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.member_roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.member_roles_id_seq OWNER TO postgres;

--
-- Name: member_roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.member_roles_id_seq OWNED BY public.member_roles.id;


--
-- Name: members; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.members (
    id integer NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    project_id integer DEFAULT 0 NOT NULL,
    created_on timestamp without time zone,
    mail_notification boolean DEFAULT false NOT NULL
);


ALTER TABLE public.members OWNER TO postgres;

--
-- Name: members_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.members_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.members_id_seq OWNER TO postgres;

--
-- Name: members_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.members_id_seq OWNED BY public.members.id;


--
-- Name: messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.messages (
    id integer NOT NULL,
    board_id integer NOT NULL,
    parent_id integer,
    subject character varying DEFAULT ''::character varying NOT NULL,
    content text,
    author_id integer,
    replies_count integer DEFAULT 0 NOT NULL,
    last_reply_id integer,
    created_on timestamp without time zone NOT NULL,
    updated_on timestamp without time zone NOT NULL,
    locked boolean DEFAULT false,
    sticky integer DEFAULT 0
);


ALTER TABLE public.messages OWNER TO postgres;

--
-- Name: messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.messages_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.messages_id_seq OWNER TO postgres;

--
-- Name: messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.messages_id_seq OWNED BY public.messages.id;


--
-- Name: news; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.news (
    id integer NOT NULL,
    project_id integer,
    title character varying(60) DEFAULT ''::character varying NOT NULL,
    summary character varying(255) DEFAULT ''::character varying,
    description text,
    author_id integer DEFAULT 0 NOT NULL,
    created_on timestamp without time zone,
    comments_count integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.news OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.news_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.news_id_seq OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;


--
-- Name: projects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projects (
    id integer NOT NULL,
    name character varying DEFAULT ''::character varying NOT NULL,
    description text,
    homepage character varying DEFAULT ''::character varying,
    is_public boolean DEFAULT true NOT NULL,
    parent_id integer,
    created_on timestamp without time zone,
    updated_on timestamp without time zone,
    identifier character varying,
    status integer DEFAULT 1 NOT NULL,
    lft integer,
    rgt integer,
    inherit_members boolean DEFAULT false NOT NULL,
    default_version_id integer,
    default_assigned_to_id integer,
    default_issue_query_id integer
);


ALTER TABLE public.projects OWNER TO postgres;

--
-- Name: projects_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.projects_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.projects_id_seq OWNER TO postgres;

--
-- Name: projects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.projects_id_seq OWNED BY public.projects.id;


--
-- Name: projects_trackers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projects_trackers (
    project_id integer DEFAULT 0 NOT NULL,
    tracker_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.projects_trackers OWNER TO postgres;

--
-- Name: queries; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.queries (
    id integer NOT NULL,
    project_id integer,
    name character varying DEFAULT ''::character varying NOT NULL,
    filters text,
    user_id integer DEFAULT 0 NOT NULL,
    column_names text,
    sort_criteria text,
    group_by character varying,
    type character varying,
    visibility integer DEFAULT 0,
    options text,
    description character varying
);


ALTER TABLE public.queries OWNER TO postgres;

--
-- Name: queries_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.queries_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.queries_id_seq OWNER TO postgres;

--
-- Name: queries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.queries_id_seq OWNED BY public.queries.id;


--
-- Name: queries_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.queries_roles (
    query_id integer NOT NULL,
    role_id integer NOT NULL
);


ALTER TABLE public.queries_roles OWNER TO postgres;

--
-- Name: repositories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.repositories (
    id integer NOT NULL,
    project_id integer DEFAULT 0 NOT NULL,
    url character varying DEFAULT ''::character varying NOT NULL,
    login character varying(60) DEFAULT ''::character varying,
    password character varying DEFAULT ''::character varying,
    root_url character varying(255) DEFAULT ''::character varying,
    type character varying,
    path_encoding character varying(64) DEFAULT NULL::character varying,
    log_encoding character varying(64) DEFAULT NULL::character varying,
    extra_info text,
    identifier character varying,
    is_default boolean DEFAULT false,
    created_on timestamp without time zone
);


ALTER TABLE public.repositories OWNER TO postgres;

--
-- Name: repositories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.repositories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.repositories_id_seq OWNER TO postgres;

--
-- Name: repositories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.repositories_id_seq OWNED BY public.repositories.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id integer NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    "position" integer,
    assignable boolean DEFAULT true,
    builtin integer DEFAULT 0 NOT NULL,
    permissions text,
    issues_visibility character varying(30) DEFAULT 'default'::character varying NOT NULL,
    users_visibility character varying(30) DEFAULT 'members_of_visible_projects'::character varying NOT NULL,
    time_entries_visibility character varying(30) DEFAULT 'all'::character varying NOT NULL,
    all_roles_managed boolean DEFAULT true NOT NULL,
    settings text,
    default_time_entry_activity_id integer
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_seq OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: roles_managed_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles_managed_roles (
    role_id integer NOT NULL,
    managed_role_id integer NOT NULL
);


ALTER TABLE public.roles_managed_roles OWNER TO postgres;

--
-- Name: schema_migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.schema_migrations (
    version character varying NOT NULL
);


ALTER TABLE public.schema_migrations OWNER TO postgres;

--
-- Name: settings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.settings (
    id integer NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    value text,
    updated_on timestamp without time zone
);


ALTER TABLE public.settings OWNER TO postgres;

--
-- Name: settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.settings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.settings_id_seq OWNER TO postgres;

--
-- Name: settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.settings_id_seq OWNED BY public.settings.id;


--
-- Name: time_entries; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.time_entries (
    id integer NOT NULL,
    project_id integer NOT NULL,
    user_id integer NOT NULL,
    issue_id integer,
    hours double precision NOT NULL,
    comments character varying(1024),
    activity_id integer NOT NULL,
    spent_on date NOT NULL,
    tyear integer NOT NULL,
    tmonth integer NOT NULL,
    tweek integer NOT NULL,
    created_on timestamp without time zone NOT NULL,
    updated_on timestamp without time zone NOT NULL,
    author_id integer
);


ALTER TABLE public.time_entries OWNER TO postgres;

--
-- Name: time_entries_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.time_entries_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.time_entries_id_seq OWNER TO postgres;

--
-- Name: time_entries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.time_entries_id_seq OWNED BY public.time_entries.id;


--
-- Name: tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tokens (
    id integer NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    action character varying(30) DEFAULT ''::character varying NOT NULL,
    value character varying(40) DEFAULT ''::character varying NOT NULL,
    created_on timestamp without time zone NOT NULL,
    updated_on timestamp without time zone
);


ALTER TABLE public.tokens OWNER TO postgres;

--
-- Name: tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tokens_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tokens_id_seq OWNER TO postgres;

--
-- Name: tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tokens_id_seq OWNED BY public.tokens.id;


--
-- Name: trackers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.trackers (
    id integer NOT NULL,
    name character varying(30) DEFAULT ''::character varying NOT NULL,
    "position" integer,
    is_in_roadmap boolean DEFAULT true NOT NULL,
    fields_bits integer DEFAULT 0,
    default_status_id integer,
    description character varying
);


ALTER TABLE public.trackers OWNER TO postgres;

--
-- Name: trackers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.trackers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.trackers_id_seq OWNER TO postgres;

--
-- Name: trackers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.trackers_id_seq OWNED BY public.trackers.id;


--
-- Name: user_preferences; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_preferences (
    id integer NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    others text,
    hide_mail boolean DEFAULT true,
    time_zone character varying
);


ALTER TABLE public.user_preferences OWNER TO postgres;

--
-- Name: user_preferences_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_preferences_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_preferences_id_seq OWNER TO postgres;

--
-- Name: user_preferences_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_preferences_id_seq OWNED BY public.user_preferences.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    login character varying DEFAULT ''::character varying NOT NULL,
    hashed_password character varying(40) DEFAULT ''::character varying NOT NULL,
    firstname character varying(30) DEFAULT ''::character varying NOT NULL,
    lastname character varying(255) DEFAULT ''::character varying NOT NULL,
    admin boolean DEFAULT false NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    last_login_on timestamp without time zone,
    language character varying(5) DEFAULT ''::character varying,
    auth_source_id integer,
    created_on timestamp without time zone,
    updated_on timestamp without time zone,
    type character varying,
    mail_notification character varying DEFAULT ''::character varying NOT NULL,
    salt character varying(64),
    must_change_passwd boolean DEFAULT false NOT NULL,
    passwd_changed_on timestamp without time zone,
    twofa_scheme character varying,
    twofa_totp_key character varying,
    twofa_totp_last_used_at integer,
    twofa_required boolean DEFAULT false
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.versions (
    id integer NOT NULL,
    project_id integer DEFAULT 0 NOT NULL,
    name character varying DEFAULT ''::character varying NOT NULL,
    description character varying DEFAULT ''::character varying,
    effective_date date,
    created_on timestamp without time zone,
    updated_on timestamp without time zone,
    wiki_page_title character varying,
    status character varying DEFAULT 'open'::character varying,
    sharing character varying DEFAULT 'none'::character varying NOT NULL
);


ALTER TABLE public.versions OWNER TO postgres;

--
-- Name: versions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.versions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.versions_id_seq OWNER TO postgres;

--
-- Name: versions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.versions_id_seq OWNED BY public.versions.id;


--
-- Name: watchers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.watchers (
    id integer NOT NULL,
    watchable_type character varying DEFAULT ''::character varying NOT NULL,
    watchable_id integer DEFAULT 0 NOT NULL,
    user_id integer
);


ALTER TABLE public.watchers OWNER TO postgres;

--
-- Name: watchers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.watchers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.watchers_id_seq OWNER TO postgres;

--
-- Name: watchers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.watchers_id_seq OWNED BY public.watchers.id;


--
-- Name: wiki_content_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wiki_content_versions (
    id integer NOT NULL,
    wiki_content_id integer NOT NULL,
    page_id integer NOT NULL,
    author_id integer,
    data bytea,
    compression character varying(6) DEFAULT ''::character varying,
    comments character varying(1024) DEFAULT ''::character varying,
    updated_on timestamp without time zone NOT NULL,
    version integer NOT NULL
);


ALTER TABLE public.wiki_content_versions OWNER TO postgres;

--
-- Name: wiki_content_versions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.wiki_content_versions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.wiki_content_versions_id_seq OWNER TO postgres;

--
-- Name: wiki_content_versions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.wiki_content_versions_id_seq OWNED BY public.wiki_content_versions.id;


--
-- Name: wiki_contents; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wiki_contents (
    id integer NOT NULL,
    page_id integer NOT NULL,
    author_id integer,
    text text,
    comments character varying(1024) DEFAULT ''::character varying,
    updated_on timestamp without time zone NOT NULL,
    version integer NOT NULL
);


ALTER TABLE public.wiki_contents OWNER TO postgres;

--
-- Name: wiki_contents_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.wiki_contents_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.wiki_contents_id_seq OWNER TO postgres;

--
-- Name: wiki_contents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.wiki_contents_id_seq OWNED BY public.wiki_contents.id;


--
-- Name: wiki_pages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wiki_pages (
    id integer NOT NULL,
    wiki_id integer NOT NULL,
    title character varying(255) NOT NULL,
    created_on timestamp without time zone NOT NULL,
    protected boolean DEFAULT false NOT NULL,
    parent_id integer
);


ALTER TABLE public.wiki_pages OWNER TO postgres;

--
-- Name: wiki_pages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.wiki_pages_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.wiki_pages_id_seq OWNER TO postgres;

--
-- Name: wiki_pages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.wiki_pages_id_seq OWNED BY public.wiki_pages.id;


--
-- Name: wiki_redirects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wiki_redirects (
    id integer NOT NULL,
    wiki_id integer NOT NULL,
    title character varying,
    redirects_to character varying,
    created_on timestamp without time zone NOT NULL,
    redirects_to_wiki_id integer NOT NULL
);


ALTER TABLE public.wiki_redirects OWNER TO postgres;

--
-- Name: wiki_redirects_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.wiki_redirects_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.wiki_redirects_id_seq OWNER TO postgres;

--
-- Name: wiki_redirects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.wiki_redirects_id_seq OWNED BY public.wiki_redirects.id;


--
-- Name: wikis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wikis (
    id integer NOT NULL,
    project_id integer NOT NULL,
    start_page character varying(255) NOT NULL,
    status integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.wikis OWNER TO postgres;

--
-- Name: wikis_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.wikis_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.wikis_id_seq OWNER TO postgres;

--
-- Name: wikis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.wikis_id_seq OWNED BY public.wikis.id;


--
-- Name: workflows; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workflows (
    id integer NOT NULL,
    tracker_id integer DEFAULT 0 NOT NULL,
    old_status_id integer DEFAULT 0 NOT NULL,
    new_status_id integer DEFAULT 0 NOT NULL,
    role_id integer DEFAULT 0 NOT NULL,
    assignee boolean DEFAULT false NOT NULL,
    author boolean DEFAULT false NOT NULL,
    type character varying(30),
    field_name character varying(30),
    rule character varying(30)
);


ALTER TABLE public.workflows OWNER TO postgres;

--
-- Name: workflows_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workflows_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.workflows_id_seq OWNER TO postgres;

--
-- Name: workflows_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workflows_id_seq OWNED BY public.workflows.id;


--
-- Name: attachments id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attachments ALTER COLUMN id SET DEFAULT nextval('public.attachments_id_seq'::regclass);


--
-- Name: auth_sources id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_sources ALTER COLUMN id SET DEFAULT nextval('public.auth_sources_id_seq'::regclass);


--
-- Name: boards id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boards ALTER COLUMN id SET DEFAULT nextval('public.boards_id_seq'::regclass);


--
-- Name: changes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.changes ALTER COLUMN id SET DEFAULT nextval('public.changes_id_seq'::regclass);


--
-- Name: changesets id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.changesets ALTER COLUMN id SET DEFAULT nextval('public.changesets_id_seq'::regclass);


--
-- Name: comments id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments ALTER COLUMN id SET DEFAULT nextval('public.comments_id_seq'::regclass);


--
-- Name: custom_field_enumerations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.custom_field_enumerations ALTER COLUMN id SET DEFAULT nextval('public.custom_field_enumerations_id_seq'::regclass);


--
-- Name: custom_fields id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.custom_fields ALTER COLUMN id SET DEFAULT nextval('public.custom_fields_id_seq'::regclass);


--
-- Name: custom_values id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.custom_values ALTER COLUMN id SET DEFAULT nextval('public.custom_values_id_seq'::regclass);


--
-- Name: documents id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documents ALTER COLUMN id SET DEFAULT nextval('public.documents_id_seq'::regclass);


--
-- Name: email_addresses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.email_addresses ALTER COLUMN id SET DEFAULT nextval('public.email_addresses_id_seq'::regclass);


--
-- Name: enabled_modules id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enabled_modules ALTER COLUMN id SET DEFAULT nextval('public.enabled_modules_id_seq'::regclass);


--
-- Name: enumerations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enumerations ALTER COLUMN id SET DEFAULT nextval('public.enumerations_id_seq'::regclass);


--
-- Name: import_items id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.import_items ALTER COLUMN id SET DEFAULT nextval('public.import_items_id_seq'::regclass);


--
-- Name: imports id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.imports ALTER COLUMN id SET DEFAULT nextval('public.imports_id_seq'::regclass);


--
-- Name: issue_categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issue_categories ALTER COLUMN id SET DEFAULT nextval('public.issue_categories_id_seq'::regclass);


--
-- Name: issue_relations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issue_relations ALTER COLUMN id SET DEFAULT nextval('public.issue_relations_id_seq'::regclass);


--
-- Name: issue_statuses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issue_statuses ALTER COLUMN id SET DEFAULT nextval('public.issue_statuses_id_seq'::regclass);


--
-- Name: issues id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issues ALTER COLUMN id SET DEFAULT nextval('public.issues_id_seq'::regclass);


--
-- Name: journal_details id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.journal_details ALTER COLUMN id SET DEFAULT nextval('public.journal_details_id_seq'::regclass);


--
-- Name: journals id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.journals ALTER COLUMN id SET DEFAULT nextval('public.journals_id_seq'::regclass);


--
-- Name: member_roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_roles ALTER COLUMN id SET DEFAULT nextval('public.member_roles_id_seq'::regclass);


--
-- Name: members id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members ALTER COLUMN id SET DEFAULT nextval('public.members_id_seq'::regclass);


--
-- Name: messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages ALTER COLUMN id SET DEFAULT nextval('public.messages_id_seq'::regclass);


--
-- Name: news id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);


--
-- Name: projects id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects ALTER COLUMN id SET DEFAULT nextval('public.projects_id_seq'::regclass);


--
-- Name: queries id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.queries ALTER COLUMN id SET DEFAULT nextval('public.queries_id_seq'::regclass);


--
-- Name: repositories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.repositories ALTER COLUMN id SET DEFAULT nextval('public.repositories_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: settings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings ALTER COLUMN id SET DEFAULT nextval('public.settings_id_seq'::regclass);


--
-- Name: time_entries id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_entries ALTER COLUMN id SET DEFAULT nextval('public.time_entries_id_seq'::regclass);


--
-- Name: tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tokens ALTER COLUMN id SET DEFAULT nextval('public.tokens_id_seq'::regclass);


--
-- Name: trackers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trackers ALTER COLUMN id SET DEFAULT nextval('public.trackers_id_seq'::regclass);


--
-- Name: user_preferences id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_preferences ALTER COLUMN id SET DEFAULT nextval('public.user_preferences_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: versions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.versions ALTER COLUMN id SET DEFAULT nextval('public.versions_id_seq'::regclass);


--
-- Name: watchers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.watchers ALTER COLUMN id SET DEFAULT nextval('public.watchers_id_seq'::regclass);


--
-- Name: wiki_content_versions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_content_versions ALTER COLUMN id SET DEFAULT nextval('public.wiki_content_versions_id_seq'::regclass);


--
-- Name: wiki_contents id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_contents ALTER COLUMN id SET DEFAULT nextval('public.wiki_contents_id_seq'::regclass);


--
-- Name: wiki_pages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_pages ALTER COLUMN id SET DEFAULT nextval('public.wiki_pages_id_seq'::regclass);


--
-- Name: wiki_redirects id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_redirects ALTER COLUMN id SET DEFAULT nextval('public.wiki_redirects_id_seq'::regclass);


--
-- Name: wikis id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wikis ALTER COLUMN id SET DEFAULT nextval('public.wikis_id_seq'::regclass);


--
-- Name: workflows id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflows ALTER COLUMN id SET DEFAULT nextval('public.workflows_id_seq'::regclass);


--
-- Data for Name: ar_internal_metadata; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ar_internal_metadata (key, value, created_at, updated_at) FROM stdin;
environment	production	2024-12-25 04:22:36.487448	2024-12-25 04:22:36.487451
\.


--
-- Data for Name: attachments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.attachments (id, container_id, container_type, filename, disk_filename, filesize, content_type, digest, downloads, author_id, created_on, description, disk_directory) FROM stdin;
\.


--
-- Data for Name: auth_sources; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auth_sources (id, type, name, host, port, account, account_password, base_dn, attr_login, attr_firstname, attr_lastname, attr_mail, onthefly_register, tls, filter, timeout, verify_peer) FROM stdin;
\.


--
-- Data for Name: boards; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.boards (id, project_id, name, description, "position", topics_count, messages_count, last_message_id, parent_id) FROM stdin;
\.


--
-- Data for Name: changes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.changes (id, changeset_id, action, path, from_path, from_revision, revision, branch) FROM stdin;
\.


--
-- Data for Name: changeset_parents; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.changeset_parents (changeset_id, parent_id) FROM stdin;
\.


--
-- Data for Name: changesets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.changesets (id, repository_id, revision, committer, committed_on, comments, commit_date, scmid, user_id) FROM stdin;
\.


--
-- Data for Name: changesets_issues; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.changesets_issues (changeset_id, issue_id) FROM stdin;
\.


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comments (id, commented_type, commented_id, author_id, content, created_on, updated_on) FROM stdin;
\.


--
-- Data for Name: custom_field_enumerations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.custom_field_enumerations (id, custom_field_id, name, active, "position") FROM stdin;
4	2	1	t	1
5	2	3	t	2
6	2	5	t	3
\.


--
-- Data for Name: custom_fields; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.custom_fields (id, type, name, field_format, possible_values, regexp, min_length, max_length, is_required, is_for_all, is_filter, "position", searchable, default_value, editable, visible, multiple, format_store, description) FROM stdin;
4	IssueCustomField	Tester	user	\N		\N	\N	f	t	f	3	f	\N	t	t	f	---\nuser_role: []\nedit_tag_style: ''\n	
3	IssueCustomField	Storie Description	user	\N		\N	\N	f	t	f	2	f	\N	t	t	f	---\nuser_role: []\nedit_tag_style: ''\n	
2	IssueCustomField	Story Points	enumeration	--- []\n		\N	\N	f	t	f	1	f		t	t	f	---\nurl_pattern: ''\nedit_tag_style: ''\n	
\.


--
-- Data for Name: custom_fields_projects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.custom_fields_projects (custom_field_id, project_id) FROM stdin;
\.


--
-- Data for Name: custom_fields_roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.custom_fields_roles (custom_field_id, role_id) FROM stdin;
\.


--
-- Data for Name: custom_fields_trackers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.custom_fields_trackers (custom_field_id, tracker_id) FROM stdin;
2	1
2	2
2	3
2	4
2	5
2	6
2	7
2	8
2	9
2	10
2	11
2	12
2	13
3	1
3	2
3	3
3	4
3	5
3	6
3	7
3	8
3	9
3	10
3	11
3	12
3	13
4	1
4	2
4	3
4	4
4	5
4	6
4	7
4	8
4	9
4	10
4	11
4	12
4	13
\.


--
-- Data for Name: custom_values; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.custom_values (id, customized_type, customized_id, custom_field_id, value) FROM stdin;
100	Issue	34	2	6
101	Issue	34	3	7
102	Issue	34	4	8
103	Issue	35	2	6
104	Issue	35	3	8
105	Issue	35	4	7
106	Issue	36	2	5
107	Issue	36	3	6
108	Issue	36	4	9
110	Issue	37	3	6
111	Issue	37	4	7
97	Issue	33	2	5
112	Issue	38	2	5
113	Issue	38	3	9
114	Issue	38	4	8
98	Issue	33	3	9
99	Issue	33	4	6
115	Issue	39	2	6
116	Issue	39	3	7
117	Issue	39	4	6
118	Issue	40	2	6
119	Issue	40	3	8
120	Issue	40	4	9
121	Issue	41	2	5
122	Issue	41	3	6
123	Issue	41	4	7
124	Issue	42	2	6
125	Issue	42	3	9
126	Issue	42	4	8
127	Issue	43	2	6
128	Issue	43	3	6
129	Issue	43	4	9
130	Issue	44	2	5
131	Issue	44	3	7
132	Issue	44	4	6
133	Issue	45	2	6
134	Issue	45	3	8
135	Issue	45	4	7
136	Issue	46	2	6
137	Issue	46	3	9
138	Issue	46	4	8
139	Issue	47	2	6
140	Issue	47	3	6
141	Issue	47	4	7
142	Issue	48	2	5
143	Issue	48	3	9
144	Issue	48	4	8
145	Issue	49	2	6
146	Issue	49	3	8
109	Issue	37	2	4
147	Issue	49	4	9
148	Issue	50	2	6
149	Issue	50	3	7
150	Issue	50	4	6
151	Issue	51	2	5
152	Issue	51	3	6
153	Issue	51	4	7
154	Issue	52	2	6
155	Issue	52	3	9
156	Issue	52	4	8
157	Issue	53	2	6
158	Issue	53	3	8
159	Issue	53	4	9
160	Issue	54	2	5
161	Issue	54	3	7
162	Issue	54	4	8
\.


--
-- Data for Name: documents; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.documents (id, project_id, category_id, title, description, created_on) FROM stdin;
\.


--
-- Data for Name: email_addresses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.email_addresses (id, user_id, address, is_default, notify, created_on, updated_on) FROM stdin;
1	1	admin@example.net	t	t	2024-12-25 04:22:39.661404	2024-12-25 04:22:39.661404
5	8	bruno.silva@example.net	t	t	2025-01-04 20:44:14.0511	2025-01-27 14:11:07.871704
3	6	henrique.santos@example.net	t	t	2024-12-25 04:43:23.656563	2025-01-27 14:11:52.501517
6	9	pedro.pereira@example.net	t	t	2025-01-04 20:45:00.365884	2025-01-27 14:12:42.77566
2	5	rodrigo.ramos@example.net	t	t	2024-12-25 04:42:36.3037	2025-01-27 14:13:19.241554
4	7	alberto.carvalho@example.net	t	t	2024-12-25 04:44:27.515585	2025-01-27 14:14:31.593426
\.


--
-- Data for Name: enabled_modules; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.enabled_modules (id, project_id, name) FROM stdin;
21	3	issue_tracking
22	3	time_tracking
23	3	news
24	3	documents
25	3	files
26	3	wiki
27	3	repository
28	3	boards
29	3	calendar
30	3	gantt
\.


--
-- Data for Name: enumerations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.enumerations (id, name, "position", is_default, type, active, project_id, parent_id, position_name) FROM stdin;
1	Baixa	1	f	IssuePriority	t	\N	\N	lowest
2	Média	2	t	IssuePriority	t	\N	\N	default
3	Alta	3	f	IssuePriority	t	\N	\N	highest
4	padrao	1	t	TimeEntryActivity	t	\N	\N	\N
\.


--
-- Data for Name: groups_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.groups_users (group_id, user_id) FROM stdin;
\.


--
-- Data for Name: import_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.import_items (id, import_id, "position", obj_id, message, unique_id) FROM stdin;
\.


--
-- Data for Name: imports; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.imports (id, type, user_id, filename, settings, total_items, finished, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: issue_categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.issue_categories (id, project_id, name, assigned_to_id) FROM stdin;
\.


--
-- Data for Name: issue_relations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.issue_relations (id, issue_from_id, issue_to_id, relation_type, delay) FROM stdin;
\.


--
-- Data for Name: issue_statuses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.issue_statuses (id, name, is_closed, "position", default_done_ratio, description) FROM stdin;
2	Desenvolvimento	f	2	\N	Desenvolvimento
1	Aberta	f	1	\N	Aberta
3	Fechada	t	3	\N	Fechada
4	Cancelada	t	4	\N	Cancelada
5	Aprovação	f	5	\N	Aprovação
\.


--
-- Data for Name: issues; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.issues (id, tracker_id, project_id, subject, description, due_date, category_id, status_id, assigned_to_id, priority_id, fixed_version_id, author_id, lock_version, created_on, updated_on, start_date, done_ratio, estimated_hours, parent_id, root_id, lft, rgt, is_private, closed_on) FROM stdin;
54	2	3	Configuração de Metas Ambientais	Criar uma funcionalidade para os gestores definirem metas ambientais nos projetos, como redução de emissões e economia de recursos, com acompanhamento de progresso.	2025-01-07	\N	1	8	2	\N	1	2	2025-01-04 21:52:17.2931	2025-01-04 22:19:40.245486	2025-01-03	0	8	\N	54	1	2	f	\N
53	2	3	Implementação de Dashboard de Performance Ambiental	Desenvolver um dashboard que exiba a performance ambiental dos projetos, com gráficos e indicadores relacionados ao impacto ambiental, eficiência e recursos utilizados.	2025-01-06	\N	1	7	2	\N	1	2	2025-01-04 21:51:07.665624	2025-01-04 22:20:16.176171	2025-01-02	0	12	\N	53	1	2	f	\N
33	2	3	Configuração Inicial do Projeto	Realizar a configuração inicial do projeto EcoTrack Solutions, incluindo a criação do repositório, estrutura de pastas e configuração do ambiente de desenvolvimento.	2024-10-08	\N	3	8	2	\N	1	5	2025-01-04 21:26:33.859398	2025-01-04 22:25:07.56184	2024-10-02	100	8	\N	33	1	2	f	2024-10-07 21:49:20.6
34	2	3	Mapeamento de Requisitos do Sistema	Identificar e documentar os principais requisitos funcionais e não funcionais do sistema EcoTrack Solutions em colaboração com o cliente.	2024-10-10	\N	3	6	2	\N	1	4	2025-01-04 21:27:31.808747	2025-01-04 22:24:52.003531	2024-10-06	100	12	\N	34	1	2	f	2024-10-10 21:49:20.722
36	2	3	Documentação do Escopo do Projeto	Criar um documento detalhado contendo o escopo do projeto, com descrição clara dos objetivos, funcionalidades e entregas esperadas.\r\n\r\n	2024-10-18	\N	3	7	2	\N	1	4	2025-01-04 21:29:33.521079	2025-01-04 22:24:20.836766	2024-10-16	100	6	\N	36	1	2	f	2024-10-18 21:49:21.067
37	2	3	Configuração do Ambiente de Integração Contínua	Configurar uma pipeline de integração contínua para o projeto EcoTrack Solutions, incluindo validação de código, execução de testes e deploy automático.\r\n\r\n	2024-10-23	\N	3	8	2	\N	1	4	2025-01-04 21:30:27.906237	2025-01-04 22:24:10.542191	2024-10-19	100	8	\N	37	1	2	f	2024-10-25 21:49:21.37
38	2	3	Criação do Layout Base da Interface	esenvolver o layout inicial do sistema EcoTrack Solutions, incluindo a estruturação básica das páginas principais e navegação.	2024-10-26	\N	3	6	2	\N	1	4	2025-01-04 21:31:21.512965	2025-01-04 22:23:57.528737	2024-10-24	100	8	\N	38	1	2	f	2024-10-24 21:49:21.551
39	2	3	Desenvolvimento do Sistema de Login	Implementar o sistema de autenticação para o EcoTrack Solutions, incluindo cadastro de usuários, login, logout e recuperação de senha.\r\n\r\n	2024-11-01	\N	3	9	2	\N	1	4	2025-01-04 21:32:42.082286	2025-01-04 22:23:48.462465	2024-10-28	100	10	\N	39	1	2	f	2024-11-01 21:49:21.762
40	2	3	Implementação do Dashboard Inicial	Desenvolver o dashboard principal do sistema EcoTrack Solutions, exibindo informações resumidas sobre os projetos e tarefas do usuário.\r\n\r\n	2024-11-06	\N	3	7	2	\N	1	4	2025-01-04 21:33:30.090188	2025-01-04 22:23:35.174581	2024-11-02	100	12	\N	40	1	2	f	2024-11-05 21:49:21.957
41	2	3	Configuração da Integração com o Redmine	Implementar a integração inicial com o Redmine, permitindo sincronização de dados básicos, como usuários e projetos.	2024-11-10	\N	3	8	2	\N	1	4	2025-01-04 21:34:57.820163	2025-01-04 22:23:26.263644	2024-11-07	100	8	\N	41	1	2	f	2024-11-11 21:49:22.155
42	2	3	Implementação do Sistema de Gerenciamento de Projetos	Criar o módulo de gerenciamento de projetos, permitindo aos usuários visualizar, criar, editar e arquivar projetos no EcoTrack Solutions.\r\n\r\n	2024-11-15	\N	3	6	2	\N	1	4	2025-01-04 21:36:18.206441	2025-01-04 22:23:16.924907	2024-11-11	100	10	\N	42	1	2	f	2024-11-15 21:49:22.353
43	2	3	Mapeamento de Impacto Ambiental	Desenvolver um módulo para registrar e categorizar os impactos ambientais associados aos projetos, permitindo análise e geração de relatórios.	2024-11-20	\N	3	7	2	\N	1	4	2025-01-04 21:37:17.057803	2025-01-04 22:23:05.503791	2024-11-16	100	12	\N	43	1	2	f	2024-11-22 21:49:22.565
44	2	3	Relatório de Sustentabilidade	Criar uma funcionalidade para gerar relatórios de sustentabilidade com base nos dados dos projetos, destacando métricas como emissões reduzidas e energia economizada.\r\n\r\n	2024-11-25	\N	3	8	2	\N	1	4	2025-01-04 21:38:04.632609	2025-01-04 22:22:54.94407	2024-11-21	100	8	\N	44	1	2	f	2024-11-25 21:49:22.756
45	2	3	Rastreamento de Emissões de CO2	Implementar um sistema para rastrear e registrar as emissões de CO2 dos projetos, com relatórios detalhados por período e categoria.\r\n\r\n	2024-11-30	\N	3	9	2	\N	1	4	2025-01-04 21:38:53.808555	2025-01-04 22:22:43.194533	2024-11-26	100	10	\N	45	1	2	f	2024-11-30 21:49:22.945
46	2	3	Monitoramento de Recursos Naturais	Desenvolver um painel para monitoramento do uso de recursos naturais nos projetos, como consumo de água, energia e materiais reciclados.	2024-12-05	\N	3	6	2	\N	1	4	2025-01-04 21:39:36.44019	2025-01-04 22:22:32.228787	2024-12-01	100	12	\N	46	1	2	f	2024-12-06 21:49:23.163
35	2	3	Criação da Estrutura do Banco de Dados	Projetar e implementar a estrutura inicial do banco de dados, incluindo tabelas, chaves primárias e relacionamentos básicos para suportar os requisitos identificados.\r\n\r\n	2024-10-15	\N	3	9	2	\N	1	5	2025-01-04 21:28:35.158838	2025-01-04 22:24:40.231564	2024-10-11	100	7.583333333333333	\N	35	1	2	f	2024-10-13 21:49:20.87
48	2	3	Análise de Eficiência Energética	Criar uma funcionalidade para calcular a eficiência energética dos projetos, destacando economia de energia e redução de custos.\r\n\r\n	2024-12-15	\N	2	6	2	\N	1	5	2025-01-04 21:44:03.823556	2025-01-04 22:22:07.827594	2024-12-11	50	8	\N	48	1	2	f	2025-01-04 21:49:23.538556
47	2	3	Implementação do Sistema de Gestão de Resíduos	Desenvolver um módulo para registrar e gerenciar resíduos gerados nos projetos, permitindo o rastreamento e a destinação correta.\r\n\r\n	2024-12-10	\N	2	9	2	\N	1	5	2025-01-04 21:42:39.6457	2025-01-04 22:22:24.263806	2024-12-06	20	10	\N	47	1	2	f	2025-01-04 21:49:23.351186
52	2	3	Relatório Comparativo de Sustentabilidade	Criar um módulo para gerar relatórios comparativos entre os projetos, destacando indicadores de sustentabilidade como emissões, consumo de recursos e eficiência.\r\n	2025-01-03	\N	1	6	2	\N	1	5	2025-01-04 21:47:41.393957	2025-01-04 22:20:45.000919	2024-12-31	0	10	\N	52	1	2	f	2025-01-04 21:49:24.299071
51	2	3	Configuração de Alertas para Impactos Ambientais	Desenvolver um sistema de alertas para notificar os gestores sobre possíveis impactos ambientais críticos nos projetos.	2024-12-30	\N	5	9	2	\N	1	5	2025-01-04 21:46:50.409695	2025-01-04 22:21:09.057945	2024-12-26	90	8	\N	51	1	2	f	2025-01-04 21:49:24.091349
50	2	3	Integração com APIs de Dados Climáticos	Implementar a integração com APIs externas para obter dados climáticos em tempo real e utilizá-los nas análises dos projetos.\r\n\r\n	2024-12-25	\N	5	8	2	\N	1	5	2025-01-04 21:45:53.393775	2025-01-04 22:21:41.699786	2024-12-21	90	10	\N	50	1	2	f	2025-01-04 21:49:23.905737
49	2	3	Desenvolvimento do Painel de Indicadores Ambientais	Implementar um painel interativo para exibir indicadores ambientais, como consumo de recursos e emissões, em tempo real.	2024-12-20	\N	5	7	2	\N	1	5	2025-01-04 21:44:58.326488	2025-01-04 22:21:49.559976	2024-12-16	80	12	\N	49	1	2	f	2025-01-04 21:49:23.740701
\.


--
-- Data for Name: journal_details; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.journal_details (id, journal_id, property, prop_key, old_value, value) FROM stdin;
256	196	attr	assigned_to_id	\N	6
257	197	attr	status_id	1	3
258	198	attr	status_id	1	3
259	199	attr	status_id	1	3
260	200	attr	status_id	1	3
261	201	attr	status_id	1	3
262	202	attr	status_id	1	3
263	203	attr	status_id	1	3
264	204	attr	status_id	1	3
265	205	attr	status_id	1	3
266	206	attr	status_id	1	3
267	207	attr	status_id	1	3
268	208	attr	status_id	1	3
269	209	attr	status_id	1	3
270	210	attr	status_id	1	3
271	211	attr	status_id	1	3
272	212	attr	status_id	1	3
273	213	attr	status_id	1	3
274	214	attr	status_id	1	3
275	215	attr	status_id	1	3
276	216	attr	status_id	1	3
277	217	attr	due_date	\N	2024-10-08
278	218	attr	estimated_hours	\N	7.583333333333333
279	219	attr	status_id	3	1
280	220	attr	status_id	3	5
281	221	attr	status_id	3	5
282	222	attr	status_id	3	5
283	223	attr	status_id	3	2
284	224	attr	status_id	3	2
285	225	attr	done_ratio	0	90
286	226	attr	done_ratio	0	90
287	227	attr	done_ratio	0	80
288	228	attr	done_ratio	0	50
289	229	attr	done_ratio	0	20
290	230	attr	done_ratio	0	100
291	231	attr	done_ratio	0	100
292	232	attr	done_ratio	0	100
293	233	attr	done_ratio	0	100
294	234	attr	done_ratio	0	100
295	235	attr	done_ratio	0	100
296	236	attr	done_ratio	0	100
297	237	attr	done_ratio	0	100
298	238	attr	done_ratio	0	100
299	239	attr	done_ratio	0	100
300	240	attr	done_ratio	0	100
301	241	attr	done_ratio	0	100
302	242	attr	done_ratio	0	100
303	243	attr	done_ratio	0	100
304	244	cf	2	6	4
\.


--
-- Data for Name: journals; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.journals (id, journalized_id, journalized_type, user_id, notes, created_on, private_notes, updated_on, updated_by_id) FROM stdin;
196	52	Issue	1		2025-01-04 21:48:57.647803	f	2025-01-04 21:48:57.647803	\N
197	33	Issue	1	\N	2025-01-04 21:49:20.605853	f	2025-01-04 21:49:20.605853	\N
198	34	Issue	1	\N	2025-01-04 21:49:20.73082	f	2025-01-04 21:49:20.73082	\N
199	35	Issue	1	\N	2025-01-04 21:49:20.877209	f	2025-01-04 21:49:20.877209	\N
200	36	Issue	1	\N	2025-01-04 21:49:21.078759	f	2025-01-04 21:49:21.078759	\N
201	37	Issue	1	\N	2025-01-04 21:49:21.379294	f	2025-01-04 21:49:21.379294	\N
202	38	Issue	1	\N	2025-01-04 21:49:21.558086	f	2025-01-04 21:49:21.558086	\N
203	39	Issue	1	\N	2025-01-04 21:49:21.772632	f	2025-01-04 21:49:21.772632	\N
204	40	Issue	1	\N	2025-01-04 21:49:21.967466	f	2025-01-04 21:49:21.967466	\N
205	41	Issue	1	\N	2025-01-04 21:49:22.166122	f	2025-01-04 21:49:22.166122	\N
206	42	Issue	1	\N	2025-01-04 21:49:22.361918	f	2025-01-04 21:49:22.361918	\N
207	43	Issue	1	\N	2025-01-04 21:49:22.574111	f	2025-01-04 21:49:22.574111	\N
208	44	Issue	1	\N	2025-01-04 21:49:22.766366	f	2025-01-04 21:49:22.766366	\N
209	45	Issue	1	\N	2025-01-04 21:49:22.957272	f	2025-01-04 21:49:22.957272	\N
210	46	Issue	1	\N	2025-01-04 21:49:23.173025	f	2025-01-04 21:49:23.173025	\N
211	47	Issue	1	\N	2025-01-04 21:49:23.358323	f	2025-01-04 21:49:23.358323	\N
212	48	Issue	1	\N	2025-01-04 21:49:23.547996	f	2025-01-04 21:49:23.547996	\N
213	49	Issue	1	\N	2025-01-04 21:49:23.748939	f	2025-01-04 21:49:23.748939	\N
214	50	Issue	1	\N	2025-01-04 21:49:23.914479	f	2025-01-04 21:49:23.914479	\N
215	51	Issue	1	\N	2025-01-04 21:49:24.101502	f	2025-01-04 21:49:24.101502	\N
216	52	Issue	1	\N	2025-01-04 21:49:24.310868	f	2025-01-04 21:49:24.310868	\N
217	33	Issue	1		2025-01-04 21:56:25.889373	f	2025-01-04 21:56:25.889373	\N
218	35	Issue	1		2025-01-04 21:56:51.214027	f	2025-01-04 21:56:51.214027	\N
219	52	Issue	1		2025-01-04 21:57:16.834711	f	2025-01-04 21:57:16.834711	\N
220	51	Issue	1		2025-01-04 21:57:25.0525	f	2025-01-04 21:57:25.0525	\N
221	50	Issue	1		2025-01-04 21:57:33.034233	f	2025-01-04 21:57:33.034233	\N
222	49	Issue	1		2025-01-04 21:57:41.22211	f	2025-01-04 21:57:41.22211	\N
223	48	Issue	1		2025-01-04 21:57:46.798926	f	2025-01-04 21:57:46.798926	\N
224	47	Issue	1		2025-01-04 21:57:57.577345	f	2025-01-04 21:57:57.577345	\N
225	51	Issue	1		2025-01-04 21:58:14.721989	f	2025-01-04 21:58:14.721989	\N
226	50	Issue	1		2025-01-04 21:58:22.403072	f	2025-01-04 21:58:22.403072	\N
227	49	Issue	1		2025-01-04 21:58:28.151197	f	2025-01-04 21:58:28.151197	\N
228	48	Issue	1		2025-01-04 21:58:40.465462	f	2025-01-04 21:58:40.465462	\N
229	47	Issue	1		2025-01-04 21:58:53.441441	f	2025-01-04 21:58:53.441441	\N
230	33	Issue	1	\N	2025-01-04 21:59:14.80449	f	2025-01-04 21:59:14.80449	\N
231	34	Issue	1	\N	2025-01-04 21:59:14.930081	f	2025-01-04 21:59:14.930081	\N
232	35	Issue	1	\N	2025-01-04 21:59:15.068179	f	2025-01-04 21:59:15.068179	\N
233	36	Issue	1	\N	2025-01-04 21:59:15.268775	f	2025-01-04 21:59:15.268775	\N
234	37	Issue	1	\N	2025-01-04 21:59:15.544508	f	2025-01-04 21:59:15.544508	\N
235	38	Issue	1	\N	2025-01-04 21:59:15.728349	f	2025-01-04 21:59:15.728349	\N
236	39	Issue	1	\N	2025-01-04 21:59:15.924402	f	2025-01-04 21:59:15.924402	\N
237	40	Issue	1	\N	2025-01-04 21:59:16.102154	f	2025-01-04 21:59:16.102154	\N
238	41	Issue	1	\N	2025-01-04 21:59:16.287235	f	2025-01-04 21:59:16.287235	\N
239	42	Issue	1	\N	2025-01-04 21:59:16.469541	f	2025-01-04 21:59:16.469541	\N
240	43	Issue	1	\N	2025-01-04 21:59:16.676267	f	2025-01-04 21:59:16.676267	\N
241	44	Issue	1	\N	2025-01-04 21:59:16.851655	f	2025-01-04 21:59:16.851655	\N
242	45	Issue	1	\N	2025-01-04 21:59:17.020159	f	2025-01-04 21:59:17.020159	\N
243	46	Issue	1	\N	2025-01-04 21:59:17.206227	f	2025-01-04 21:59:17.206227	\N
244	37	Issue	1		2025-01-04 22:24:10.548898	f	2025-01-04 22:24:10.548898	\N
\.


--
-- Data for Name: member_roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.member_roles (id, member_id, role_id, inherited_from) FROM stdin;
16	8	4	\N
17	9	3	\N
18	10	3	\N
19	11	3	\N
20	12	3	\N
21	13	4	\N
\.


--
-- Data for Name: members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.members (id, user_id, project_id, created_on, mail_notification) FROM stdin;
13	1	3	2025-01-27 14:09:37.98934	f
9	8	3	2025-01-04 20:46:48.029313	f
10	6	3	2025-01-04 20:46:48.036564	f
11	9	3	2025-01-04 20:46:48.04242	f
8	5	3	2025-01-04 20:46:31.73367	f
12	7	3	2025-01-04 20:46:48.048649	f
\.


--
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.messages (id, board_id, parent_id, subject, content, author_id, replies_count, last_reply_id, created_on, updated_on, locked, sticky) FROM stdin;
\.


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news (id, project_id, title, summary, description, author_id, created_on, comments_count) FROM stdin;
\.


--
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects (id, name, description, homepage, is_public, parent_id, created_on, updated_on, identifier, status, lft, rgt, inherit_members, default_version_id, default_assigned_to_id, default_issue_query_id) FROM stdin;
3	EcoTrack Solutions	O EcoTrack Solutions é uma plataforma inovadora focada no monitoramento e gestão de iniciativas ambientais e projetos de sustentabilidade. O sistema permite que organizações rastreiem indicadores ambientais, como emissões de carbono, consumo de energia e gestão de resíduos, enquanto promovem ações sustentáveis e avaliam o impacto de suas operações. Com ferramentas para análise de dados e relatórios detalhados, o EcoTrack Solutions ajuda empresas e ONGs a atingirem metas de sustentabilidade e contribuírem para um futuro mais verde.		f	\N	2024-10-01 20:46:20.303	2025-01-04 20:46:20.303397	ecotrack-solutions	1	1	2	f	\N	\N	\N
\.


--
-- Data for Name: projects_trackers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects_trackers (project_id, tracker_id) FROM stdin;
3	1
3	2
3	3
3	4
3	5
3	6
3	7
3	8
3	9
3	10
3	11
3	12
3	13
\.


--
-- Data for Name: queries; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.queries (id, project_id, name, filters, user_id, column_names, sort_criteria, group_by, type, visibility, options, description) FROM stdin;
\.


--
-- Data for Name: queries_roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.queries_roles (query_id, role_id) FROM stdin;
\.


--
-- Data for Name: repositories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.repositories (id, project_id, url, login, password, root_url, type, path_encoding, log_encoding, extra_info, identifier, is_default, created_on) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id, name, "position", assignable, builtin, permissions, issues_visibility, users_visibility, time_entries_visibility, all_roles_managed, settings, default_time_entry_activity_id) FROM stdin;
1	Non member	0	t	1	---\n- :view_issues\n- :view_news\n- :view_messages\n	default	members_of_visible_projects	all	t	\N	\N
2	Anonymous	0	t	2	---\n- :view_issues\n- :view_news\n- :view_messages\n	default	members_of_visible_projects	all	t	\N	\N
3	Developer	1	t	0	---\n- :view_messages\n- :view_issues\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
6	Infra	4	t	0	---\n- :view_messages\n- :view_issues\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
7	Arquiteto de Software	5	t	0	---\n- :view_messages\n- :view_issues\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
8	Product Owner	6	t	0	---\n- :view_messages\n- :view_issues\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
9	Teste API	7	t	0	---\n- :view_messages\n- :view_issues\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
10	Tester	8	t	0	---\n- :view_messages\n- :view_issues\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
11	DevOps	9	t	0	---\n- :view_messages\n- :view_issues\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
4	Manager	2	t	0	---\n- :add_project\n- :edit_project\n- :close_project\n- :delete_project\n- :select_project_publicity\n- :select_project_modules\n- :manage_members\n- :manage_versions\n- :add_subprojects\n- :manage_public_queries\n- :save_queries\n- :view_messages\n- :add_messages\n- :edit_messages\n- :edit_own_messages\n- :delete_messages\n- :delete_own_messages\n- :view_message_watchers\n- :add_message_watchers\n- :delete_message_watchers\n- :manage_boards\n- :view_calendar\n- :view_documents\n- :add_documents\n- :edit_documents\n- :delete_documents\n- :view_files\n- :manage_files\n- :view_gantt\n- :view_issues\n- :add_issues\n- :edit_issues\n- :edit_own_issues\n- :copy_issues\n- :manage_issue_relations\n- :manage_subtasks\n- :set_issues_private\n- :set_own_issues_private\n- :add_issue_notes\n- :edit_issue_notes\n- :edit_own_issue_notes\n- :view_private_notes\n- :set_notes_private\n- :delete_issues\n- :view_issue_watchers\n- :add_issue_watchers\n- :delete_issue_watchers\n- :import_issues\n- :manage_categories\n- :view_news\n- :manage_news\n- :comment_news\n- :view_changesets\n- :browse_repository\n- :commit_access\n- :manage_related_issues\n- :manage_repository\n- :view_time_entries\n- :log_time\n- :edit_time_entries\n- :edit_own_time_entries\n- :manage_project_activities\n- :log_time_for_other_users\n- :import_time_entries\n- :view_wiki_pages\n- :view_wiki_edits\n- :export_wiki_pages\n- :edit_wiki_pages\n- :rename_wiki_pages\n- :delete_wiki_pages\n- :delete_wiki_pages_attachments\n- :view_wiki_page_watchers\n- :add_wiki_page_watchers\n- :delete_wiki_page_watchers\n- :protect_wiki_pages\n- :manage_wiki\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
5	Team Leader	3	t	0	---\n- :view_messages\n- :view_issues\n- :add_issues\n- :edit_issues\n- :edit_own_issues\n- :copy_issues\n- :manage_issue_relations\n- :manage_subtasks\n- :set_issues_private\n- :set_own_issues_private\n- :add_issue_notes\n- :edit_issue_notes\n- :edit_own_issue_notes\n- :view_private_notes\n- :set_notes_private\n- :delete_issues\n- :view_issue_watchers\n- :add_issue_watchers\n- :delete_issue_watchers\n- :import_issues\n- :manage_categories\n- :view_news\n	default	members_of_visible_projects	all	t	---\npermissions_all_trackers:\n  view_issues: '1'\n  add_issues: '0'\n  edit_issues: '0'\n  add_issue_notes: '0'\n  delete_issues: '0'\npermissions_tracker_ids:\n  view_issues: []\n  add_issues: []\n  edit_issues: []\n  add_issue_notes: []\n  delete_issues: []\n	\N
\.


--
-- Data for Name: roles_managed_roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles_managed_roles (role_id, managed_role_id) FROM stdin;
\.


--
-- Data for Name: schema_migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.schema_migrations (version) FROM stdin;
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
87
88
89
90
91
92
93
94
95
96
97
98
99
100
101
102
103
104
105
106
107
108
20090214190337
20090312172426
20090312194159
20090318181151
20090323224724
20090401221305
20090401231134
20090403001910
20090406161854
20090425161243
20090503121501
20090503121505
20090503121510
20090614091200
20090704172350
20090704172355
20090704172358
20091010093521
20091017212227
20091017212457
20091017212644
20091017212938
20091017213027
20091017213113
20091017213151
20091017213228
20091017213257
20091017213332
20091017213444
20091017213536
20091017213642
20091017213716
20091017213757
20091017213835
20091017213910
20091017214015
20091017214107
20091017214136
20091017214236
20091017214308
20091017214336
20091017214406
20091017214440
20091017214519
20091017214611
20091017214644
20091017214720
20091017214750
20091025163651
20091108092559
20091114105931
20091123212029
20091205124427
20091220183509
20091220183727
20091220184736
20091225164732
20091227112908
20100129193402
20100129193813
20100221100219
20100313132032
20100313171051
20100705164950
20100819172912
20101104182107
20101107130441
20101114115114
20101114115359
20110220160626
20110223180944
20110223180953
20110224000000
20110226120112
20110226120132
20110227125750
20110228000000
20110228000100
20110401192910
20110408103312
20110412065600
20110511000000
20110902000000
20111201201315
20120115143024
20120115143100
20120115143126
20120127174243
20120205111326
20120223110929
20120301153455
20120422150750
20120705074331
20120707064544
20120714122000
20120714122100
20120714122200
20120731164049
20120930112914
20121026002032
20121026003537
20121209123234
20121209123358
20121213084931
20130110122628
20130201184705
20130202090625
20130207175206
20130207181455
20130215073721
20130215111127
20130215111141
20130217094251
20130602092539
20130710182539
20130713104233
20130713111657
20130729070143
20130911193200
20131004113137
20131005100610
20131124175346
20131210180802
20131214094309
20131215104612
20131218183023
20140228130325
20140903143914
20140920094058
20141029181752
20141029181824
20141109112308
20141122124142
20150113194759
20150113211532
20150113213922
20150113213955
20150208105930
20150510083747
20150525103953
20150526183158
20150528084820
20150528092912
20150528093249
20150725112753
20150730122707
20150730122735
20150921204850
20150921210243
20151020182334
20151020182731
20151021184614
20151021185456
20151021190616
20151024082034
20151025072118
20151031095005
20160404080304
20160416072926
20160529063352
20161001122012
20161002133421
20161010081301
20161010081528
20161010081600
20161126094932
20161220091118
20170207050700
20170302015225
20170309214320
20170320051650
20170418090031
20170419144536
20170723112801
20180501132547
20180913072918
20180923082945
20180923091603
20190315094151
20190315102101
20190510070108
20190620135549
20200826153401
20200826153402
20210704125704
20210705111300
20210728131544
20210801145548
20210801211024
20211213122100
20211213122101
20211213122102
20220224194639
20220714093000
20220714093010
20220806215628
20221002193055
20221004172825
20221012135202
20221214173537
20230818020734
20231012112407
20231113131245
20240213101801
20241007144951
20241022095140
20241026031710
20241103150135
20241103184550
\.


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.settings (id, name, value, updated_on) FROM stdin;
1	default_notification_option	only_assigned	\N
2	text_formatting	common_mark	\N
3	rest_api_enabled	1	2024-12-25 04:27:18.465147
4	jsonp_enabled	1	2024-12-25 04:27:18.477965
\.


--
-- Data for Name: time_entries; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.time_entries (id, project_id, user_id, issue_id, hours, comments, activity_id, spent_on, tyear, tmonth, tweek, created_on, updated_on, author_id) FROM stdin;
9	3	1	54	5.716666666666667		4	2025-01-04	2025	1	1	2025-01-04 22:19:40.227006	2025-01-04 22:19:40.227006	1
10	3	1	53	7.383333333333334		4	2025-01-04	2025	1	1	2025-01-04 22:20:16.160009	2025-01-04 22:20:16.160009	1
11	3	1	52	4.566666666666666		4	2025-01-04	2025	1	1	2025-01-04 22:20:44.984022	2025-01-04 22:20:44.984022	1
12	3	1	51	7.066666666666666		4	2025-01-04	2025	1	1	2025-01-04 22:21:09.043014	2025-01-04 22:21:09.043014	1
13	3	1	50	9		4	2025-01-04	2025	1	1	2025-01-04 22:21:41.684399	2025-01-04 22:21:41.684399	1
14	3	1	49	11		4	2025-01-04	2025	1	1	2025-01-04 22:21:49.545585	2025-01-04 22:21:49.545585	1
15	3	1	48	11		4	2025-01-04	2025	1	1	2025-01-04 22:22:07.811414	2025-01-04 22:22:07.811414	1
16	3	1	47	9		4	2025-01-04	2025	1	1	2025-01-04 22:22:24.247286	2025-01-04 22:22:24.247286	1
17	3	1	46	9		4	2025-01-04	2025	1	1	2025-01-04 22:22:32.211855	2025-01-04 22:22:32.211855	1
18	3	1	45	7.566666666666666		4	2025-01-04	2025	1	1	2025-01-04 22:22:43.179162	2025-01-04 22:22:43.179162	1
19	3	1	44	9.183333333333334		4	2025-01-04	2025	1	1	2025-01-04 22:22:54.927887	2025-01-04 22:22:54.927887	1
20	3	1	43	3		4	2025-01-04	2025	1	1	2025-01-04 22:23:05.488086	2025-01-04 22:23:05.488086	1
21	3	1	42	10		4	2025-01-04	2025	1	1	2025-01-04 22:23:16.908604	2025-01-04 22:23:16.908604	1
22	3	1	41	7.5		4	2025-01-04	2025	1	1	2025-01-04 22:23:26.248562	2025-01-04 22:23:26.248562	1
23	3	1	40	11		4	2025-01-04	2025	1	1	2025-01-04 22:23:35.158128	2025-01-04 22:23:35.158128	1
24	3	1	39	9		4	2025-01-04	2025	1	1	2025-01-04 22:23:48.447496	2025-01-04 22:23:48.447496	1
25	3	1	38	9		4	2025-01-04	2025	1	1	2025-01-04 22:23:57.513555	2025-01-04 22:23:57.513555	1
26	3	1	37	2		4	2025-01-04	2025	1	1	2025-01-04 22:24:10.526542	2025-01-04 22:24:10.526542	1
27	3	1	36	7		4	2025-01-04	2025	1	1	2025-01-04 22:24:20.819903	2025-01-04 22:24:20.819903	1
28	3	1	35	7		4	2025-01-04	2025	1	1	2025-01-04 22:24:40.21545	2025-01-04 22:24:40.21545	1
29	3	1	34	13		4	2025-01-04	2025	1	1	2025-01-04 22:24:51.987443	2025-01-04 22:24:51.987443	1
30	3	1	33	8		4	2025-01-04	2025	1	1	2025-01-04 22:25:07.546172	2025-01-04 22:25:07.546172	1
\.


--
-- Data for Name: tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tokens (id, user_id, action, value, created_on, updated_on) FROM stdin;
4	1	feeds	2d7aaad027730e2d3acb402c9ab0ca7f9ed271eb	2024-12-25 04:25:20.076602	2024-12-25 04:25:20.076602
2	1	session	82dd7571fb64eb086d0298c5f67a4464a5754161	2024-12-25 04:23:39.211972	2024-12-25 04:27:01.080537
5	1	api	701418bde932b0b4bbe560ccdf09eb2e33476ff6	2024-12-25 04:27:23.420698	2024-12-25 04:27:23.420698
11	1	session	1594ec3294c5f0444a15b755d1b452ab6690b722	2024-12-27 20:29:11.933536	2024-12-30 17:38:07.941731
15	1	session	8ec04a1b04d371220d2754b337e1c06e1e3d5cc7	2025-01-01 18:57:16.943197	2025-01-01 18:57:16.943197
8	5	feeds	b08c36247e690c865f496bbd6a5616b1fb06ac21	2024-12-25 05:56:50.980562	2024-12-25 05:56:50.980562
9	5	api	9c3006c8dfe97b984164615f96f7548f577003fd	2024-12-25 05:56:55.639667	2024-12-25 05:56:55.639667
20	1	session	d7dad3a16f0cf973fbdd9dd3decd5651d4e11db9	2025-01-04 21:06:30.854316	2025-01-04 22:14:03.653388
10	1	session	d9813f01c10f22fb454f11c7943cb60878bfd76d	2024-12-25 05:58:57.989911	2024-12-26 18:46:45.441972
13	6	feeds	79f80e7c028bd56b3bc63327e75e569872dc0350	2024-12-27 20:31:50.958015	2024-12-27 20:31:50.958015
14	6	api	1ffd9ad42556a4262bbf06978fedd2ae942e51b5	2024-12-27 20:31:59.729903	2024-12-27 20:31:59.729903
21	1	session	94a740177e5384389be29af34394823936188cc6	2025-01-04 22:18:12.191806	2025-01-04 22:43:50.798165
23	1	session	3ded127803cae41a6d894651f585a1bd2c683a66	2025-01-06 13:30:39.533334	2025-01-06 13:32:47.576218
17	1	session	dd6d301773eb184a2e24b941c64da2c2cefa3595	2025-01-03 21:03:51.16181	2025-01-04 19:27:28.548592
18	1	session	d17cb69700f88fdc289004018e532765eb71c47a	2025-01-04 20:42:32.864215	2025-01-04 20:49:16.569922
25	1	session	0acf1800e0265b6d0665761a75f05617ac2b0f66	2025-01-27 14:17:44.209789	2025-01-27 14:58:17.08947
\.


--
-- Data for Name: trackers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.trackers (id, name, "position", is_in_roadmap, fields_bits, default_status_id, description) FROM stdin;
1	test	1	t	0	1	
2	feat	2	t	0	1	
3	refac	3	t	0	1	
4	bug	4	t	0	1	
5	doc	5	t	0	1	
6	req	6	t	0	1	
7	design	7	t	0	1	
8	study	8	t	0	1	
9	revert	9	t	0	1	
10	infra	10	t	0	1	
11	backlog	11	t	0	1	
12	epic	12	t	0	1	
13	story	13	t	0	1	
\.


--
-- Data for Name: user_preferences; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_preferences (id, user_id, others, hide_mail, time_zone) FROM stdin;
3	6	---\n:no_self_notified: '1'\n:auto_watch_on:\n- ''\n- issue_created\n- issue_contributed_to\n:comments_sorting: asc\n:warn_on_leaving_unsaved: '1'\n:textarea_font: ''\n:recently_used_projects: 3\n:history_default_tab: notes\n:toolbar_language_options: c,cpp,csharp,css,diff,go,groovy,html,java,javascript,objc,perl,php,python,r,ruby,sass,scala,shell,sql,swift,xml,yaml\n:default_issue_query: ''\n:default_project_query: ''\n:my_page_layout:\n  left:\n  - issuesassignedtome\n  right:\n  - issuesreportedbyme\n:my_page_settings: {}\n:recently_used_project_ids: '3,2,1'\n:notify_about_high_priority_issues: '0'\n	t	
2	5	---\n:no_self_notified: '1'\n:auto_watch_on:\n- ''\n- issue_created\n- issue_contributed_to\n:comments_sorting: asc\n:warn_on_leaving_unsaved: '1'\n:textarea_font: ''\n:recently_used_projects: 3\n:history_default_tab: notes\n:toolbar_language_options: c,cpp,csharp,css,diff,go,groovy,html,java,javascript,objc,perl,php,python,r,ruby,sass,scala,shell,sql,swift,xml,yaml\n:default_issue_query: ''\n:default_project_query: ''\n:my_page_layout:\n  left:\n  - issuesassignedtome\n  right:\n  - issuesreportedbyme\n:my_page_settings: {}\n:recently_used_project_ids: '3,2,1'\n:notify_about_high_priority_issues: '0'\n	t	
4	7	---\n:no_self_notified: '1'\n:auto_watch_on:\n- ''\n- issue_created\n- issue_contributed_to\n:comments_sorting: asc\n:warn_on_leaving_unsaved: '1'\n:textarea_font: ''\n:recently_used_projects: 3\n:history_default_tab: notes\n:toolbar_language_options: c,cpp,csharp,css,diff,go,groovy,html,java,javascript,objc,perl,php,python,r,ruby,sass,scala,shell,sql,swift,xml,yaml\n:default_issue_query: ''\n:default_project_query: ''\n:my_page_layout:\n  left:\n  - issuesassignedtome\n  right:\n  - issuesreportedbyme\n:my_page_settings: {}\n:notify_about_high_priority_issues: '0'\n	t	
5	8	---\n:no_self_notified: '1'\n:auto_watch_on:\n- ''\n- issue_created\n- issue_contributed_to\n:notify_about_high_priority_issues: '0'\n:comments_sorting: asc\n:warn_on_leaving_unsaved: '1'\n:textarea_font: ''\n:recently_used_projects: 3\n:history_default_tab: notes\n:toolbar_language_options: c,cpp,csharp,css,diff,go,groovy,html,java,javascript,objc,perl,php,python,r,ruby,sass,scala,shell,sql,swift,xml,yaml\n:default_issue_query: ''\n:default_project_query: ''\n:my_page_layout:\n  left:\n  - issuesassignedtome\n  right:\n  - issuesreportedbyme\n:my_page_settings: {}\n	t	
6	9	---\n:no_self_notified: '1'\n:auto_watch_on:\n- ''\n- issue_created\n- issue_contributed_to\n:notify_about_high_priority_issues: '0'\n:comments_sorting: asc\n:warn_on_leaving_unsaved: '1'\n:textarea_font: ''\n:recently_used_projects: 3\n:history_default_tab: notes\n:toolbar_language_options: c,cpp,csharp,css,diff,go,groovy,html,java,javascript,objc,perl,php,python,r,ruby,sass,scala,shell,sql,swift,xml,yaml\n:default_issue_query: ''\n:default_project_query: ''\n:my_page_layout:\n  left:\n  - issuesassignedtome\n  right:\n  - issuesreportedbyme\n:my_page_settings: {}\n	t	
1	1	---\n:no_self_notified: '1'\n:auto_watch_on:\n- issue_created\n- issue_contributed_to\n:my_page_layout:\n  left:\n  - issuesassignedtome\n  right:\n  - issuesreportedbyme\n:my_page_settings: {}\n:activity_scope:\n- issues\n- changesets\n- news\n- documents\n- files\n- wiki_edits\n- messages\n- time_entries\n:recently_used_project_ids: '3,1,2'\n:gantt_zoom: 2\n:gantt_months: 6\n	t	
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, login, hashed_password, firstname, lastname, admin, status, last_login_on, language, auth_source_id, created_on, updated_on, type, mail_notification, salt, must_change_passwd, passwd_changed_on, twofa_scheme, twofa_totp_key, twofa_totp_last_used_at, twofa_required) FROM stdin;
2				Anonymous users	f	1	\N		\N	2024-12-25 04:22:39.570731	2024-12-25 04:22:39.570731	GroupAnonymous		\N	f	\N	\N	\N	\N	f
3				Non member users	f	1	\N		\N	2024-12-25 04:22:39.611735	2024-12-25 04:22:39.611735	GroupNonMember		\N	f	\N	\N	\N	\N	f
4				Anonymous	f	0	\N		\N	2024-12-25 04:23:08.903862	2024-12-25 04:23:08.903862	AnonymousUser	only_assigned	\N	f	\N	\N	\N	\N	f
6	henrique.santos	a617e8e27e614013966f37c195fc72006ebe3664	Henrique	Borges dos Santos	t	1	2025-01-05 20:27:40.962641		\N	2024-12-25 04:43:23.646763	2025-01-06 13:32:47.625347	User	only_assigned	5c8e2d288bc4deeefd3d2e0924139459	f	2025-01-06 13:32:47	\N	\N	\N	f
8	bruno.silva	84f3f0156dd8e8e5e4635d7c27c7fe58bc09bcc6	Bruno	Silva	f	1	\N	pt-BR	\N	2025-01-04 20:44:14.039214	2025-01-27 14:11:07.870834	User	only_assigned	5ab48247f5eb5e05fd73eedcd822a50d	f	2025-01-06 13:32:34	\N	\N	\N	f
9	pedro.pereira	ed245bc90d02144d2afc5a035ac595763ba8734c	Pedro	Pereira	f	1	\N	pt-BR	\N	2025-01-04 20:45:00.356099	2025-01-27 14:12:42.775042	User	only_assigned	974b780411921136c62ed5dad0643c17	f	2025-01-06 13:33:01	\N	\N	\N	f
5	rodrigo.ramos	4f19f2afabe3576764c028778401c265431943b0	Rodrigo	Ramos	f	1	2025-01-04 21:05:52.545849		\N	2024-12-25 04:42:36.292159	2025-01-27 14:13:19.240906	User	only_assigned	2cac31790be38ec1c2ad7de21fb16529	f	2025-01-06 13:33:14	\N	\N	\N	f
7	alberto.carvalho	7f5d39e813a8b33870d76bb297d4976fa9984a1e	Alberto	Carvalho	f	1	\N		\N	2024-12-25 04:44:27.503224	2025-01-27 14:14:31.59272	User	only_assigned	031fc8acfe7df6105622fdb312bcf33a	f	2025-01-06 13:33:27	\N	\N	\N	f
1	admin	ef30d49eb3550dd1db291d28f82085e568b55b3a	Redmine	Admin	t	1	2025-01-27 14:17:44.207863		\N	2024-12-25 04:22:36.689431	2024-12-25 04:23:39.189989	User	all	0551284b7be4bf0ffd125cd06a547a19	f	2024-12-25 04:23:39	\N	\N	\N	f
\.


--
-- Data for Name: versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.versions (id, project_id, name, description, effective_date, created_on, updated_on, wiki_page_title, status, sharing) FROM stdin;
2	3	1.0.0	1.0.0	\N	2025-01-04 22:13:20.795175	2025-01-04 22:13:20.795175		open	none
3	3	1.0.1	1.0.1	\N	2025-01-04 22:13:34.538331	2025-01-04 22:13:34.538331		open	none
4	3	1.0.2	1.0.2	\N	2025-01-04 22:14:03.677679	2025-01-04 22:14:03.677679		open	none
5	3	1.0.3	1.0.3	\N	2025-01-04 22:14:17.518639	2025-01-04 22:14:17.518639		open	none
\.


--
-- Data for Name: watchers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.watchers (id, watchable_type, watchable_id, user_id) FROM stdin;
33	Issue	33	1
34	Issue	34	1
35	Issue	35	1
36	Issue	36	1
37	Issue	37	1
38	Issue	38	1
39	Issue	39	1
40	Issue	40	1
41	Issue	41	1
42	Issue	42	1
43	Issue	43	1
44	Issue	44	1
45	Issue	45	1
46	Issue	46	1
47	Issue	47	1
48	Issue	48	1
49	Issue	49	1
50	Issue	50	1
51	Issue	51	1
52	Issue	52	1
53	Issue	53	1
54	Issue	54	1
\.


--
-- Data for Name: wiki_content_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wiki_content_versions (id, wiki_content_id, page_id, author_id, data, compression, comments, updated_on, version) FROM stdin;
\.


--
-- Data for Name: wiki_contents; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wiki_contents (id, page_id, author_id, text, comments, updated_on, version) FROM stdin;
\.


--
-- Data for Name: wiki_pages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wiki_pages (id, wiki_id, title, created_on, protected, parent_id) FROM stdin;
\.


--
-- Data for Name: wiki_redirects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wiki_redirects (id, wiki_id, title, redirects_to, created_on, redirects_to_wiki_id) FROM stdin;
\.


--
-- Data for Name: wikis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wikis (id, project_id, start_page, status) FROM stdin;
3	3	Wiki	1
\.


--
-- Data for Name: workflows; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workflows (id, tracker_id, old_status_id, new_status_id, role_id, assignee, author, type, field_name, rule) FROM stdin;
1	1	0	1	4	f	f	WorkflowTransition	\N	\N
2	1	0	1	5	f	f	WorkflowTransition	\N	\N
3	2	0	1	4	f	f	WorkflowTransition	\N	\N
4	2	0	1	5	f	f	WorkflowTransition	\N	\N
5	3	0	1	4	f	f	WorkflowTransition	\N	\N
6	3	0	1	5	f	f	WorkflowTransition	\N	\N
7	4	0	1	4	f	f	WorkflowTransition	\N	\N
8	4	0	1	5	f	f	WorkflowTransition	\N	\N
9	5	0	1	4	f	f	WorkflowTransition	\N	\N
10	5	0	1	5	f	f	WorkflowTransition	\N	\N
11	6	0	1	4	f	f	WorkflowTransition	\N	\N
12	6	0	1	5	f	f	WorkflowTransition	\N	\N
13	7	0	1	4	f	f	WorkflowTransition	\N	\N
14	7	0	1	5	f	f	WorkflowTransition	\N	\N
15	8	0	1	4	f	f	WorkflowTransition	\N	\N
16	8	0	1	5	f	f	WorkflowTransition	\N	\N
17	9	0	1	4	f	f	WorkflowTransition	\N	\N
18	9	0	1	5	f	f	WorkflowTransition	\N	\N
19	10	0	1	4	f	f	WorkflowTransition	\N	\N
20	10	0	1	5	f	f	WorkflowTransition	\N	\N
21	11	0	1	4	f	f	WorkflowTransition	\N	\N
22	11	0	1	5	f	f	WorkflowTransition	\N	\N
23	12	0	1	4	f	f	WorkflowTransition	\N	\N
24	12	0	1	5	f	f	WorkflowTransition	\N	\N
25	13	0	1	4	f	f	WorkflowTransition	\N	\N
26	13	0	1	5	f	f	WorkflowTransition	\N	\N
27	1	0	2	4	f	f	WorkflowTransition	\N	\N
28	1	0	2	5	f	f	WorkflowTransition	\N	\N
29	2	0	2	4	f	f	WorkflowTransition	\N	\N
30	2	0	2	5	f	f	WorkflowTransition	\N	\N
31	3	0	2	4	f	f	WorkflowTransition	\N	\N
32	3	0	2	5	f	f	WorkflowTransition	\N	\N
33	4	0	2	4	f	f	WorkflowTransition	\N	\N
34	4	0	2	5	f	f	WorkflowTransition	\N	\N
35	5	0	2	4	f	f	WorkflowTransition	\N	\N
36	5	0	2	5	f	f	WorkflowTransition	\N	\N
37	6	0	2	4	f	f	WorkflowTransition	\N	\N
38	6	0	2	5	f	f	WorkflowTransition	\N	\N
39	7	0	2	4	f	f	WorkflowTransition	\N	\N
40	7	0	2	5	f	f	WorkflowTransition	\N	\N
41	8	0	2	4	f	f	WorkflowTransition	\N	\N
42	8	0	2	5	f	f	WorkflowTransition	\N	\N
43	9	0	2	4	f	f	WorkflowTransition	\N	\N
44	9	0	2	5	f	f	WorkflowTransition	\N	\N
45	10	0	2	4	f	f	WorkflowTransition	\N	\N
46	10	0	2	5	f	f	WorkflowTransition	\N	\N
47	11	0	2	4	f	f	WorkflowTransition	\N	\N
48	11	0	2	5	f	f	WorkflowTransition	\N	\N
49	12	0	2	4	f	f	WorkflowTransition	\N	\N
50	12	0	2	5	f	f	WorkflowTransition	\N	\N
51	13	0	2	4	f	f	WorkflowTransition	\N	\N
52	13	0	2	5	f	f	WorkflowTransition	\N	\N
53	1	0	3	4	f	f	WorkflowTransition	\N	\N
54	1	0	3	5	f	f	WorkflowTransition	\N	\N
55	2	0	3	4	f	f	WorkflowTransition	\N	\N
56	2	0	3	5	f	f	WorkflowTransition	\N	\N
57	3	0	3	4	f	f	WorkflowTransition	\N	\N
58	3	0	3	5	f	f	WorkflowTransition	\N	\N
59	4	0	3	4	f	f	WorkflowTransition	\N	\N
60	4	0	3	5	f	f	WorkflowTransition	\N	\N
61	5	0	3	4	f	f	WorkflowTransition	\N	\N
62	5	0	3	5	f	f	WorkflowTransition	\N	\N
63	6	0	3	4	f	f	WorkflowTransition	\N	\N
64	6	0	3	5	f	f	WorkflowTransition	\N	\N
65	7	0	3	4	f	f	WorkflowTransition	\N	\N
66	7	0	3	5	f	f	WorkflowTransition	\N	\N
67	8	0	3	4	f	f	WorkflowTransition	\N	\N
68	8	0	3	5	f	f	WorkflowTransition	\N	\N
69	9	0	3	4	f	f	WorkflowTransition	\N	\N
70	9	0	3	5	f	f	WorkflowTransition	\N	\N
71	10	0	3	4	f	f	WorkflowTransition	\N	\N
72	10	0	3	5	f	f	WorkflowTransition	\N	\N
73	11	0	3	4	f	f	WorkflowTransition	\N	\N
74	11	0	3	5	f	f	WorkflowTransition	\N	\N
75	12	0	3	4	f	f	WorkflowTransition	\N	\N
76	12	0	3	5	f	f	WorkflowTransition	\N	\N
77	13	0	3	4	f	f	WorkflowTransition	\N	\N
78	13	0	3	5	f	f	WorkflowTransition	\N	\N
79	1	0	4	4	f	f	WorkflowTransition	\N	\N
80	1	0	4	5	f	f	WorkflowTransition	\N	\N
81	2	0	4	4	f	f	WorkflowTransition	\N	\N
82	2	0	4	5	f	f	WorkflowTransition	\N	\N
83	3	0	4	4	f	f	WorkflowTransition	\N	\N
84	3	0	4	5	f	f	WorkflowTransition	\N	\N
85	4	0	4	4	f	f	WorkflowTransition	\N	\N
86	4	0	4	5	f	f	WorkflowTransition	\N	\N
87	5	0	4	4	f	f	WorkflowTransition	\N	\N
88	5	0	4	5	f	f	WorkflowTransition	\N	\N
89	6	0	4	4	f	f	WorkflowTransition	\N	\N
90	6	0	4	5	f	f	WorkflowTransition	\N	\N
91	7	0	4	4	f	f	WorkflowTransition	\N	\N
92	7	0	4	5	f	f	WorkflowTransition	\N	\N
93	8	0	4	4	f	f	WorkflowTransition	\N	\N
94	8	0	4	5	f	f	WorkflowTransition	\N	\N
95	9	0	4	4	f	f	WorkflowTransition	\N	\N
96	9	0	4	5	f	f	WorkflowTransition	\N	\N
97	10	0	4	4	f	f	WorkflowTransition	\N	\N
98	10	0	4	5	f	f	WorkflowTransition	\N	\N
99	11	0	4	4	f	f	WorkflowTransition	\N	\N
100	11	0	4	5	f	f	WorkflowTransition	\N	\N
101	12	0	4	4	f	f	WorkflowTransition	\N	\N
102	12	0	4	5	f	f	WorkflowTransition	\N	\N
103	13	0	4	4	f	f	WorkflowTransition	\N	\N
104	13	0	4	5	f	f	WorkflowTransition	\N	\N
105	1	0	5	4	f	f	WorkflowTransition	\N	\N
106	1	0	5	5	f	f	WorkflowTransition	\N	\N
107	2	0	5	4	f	f	WorkflowTransition	\N	\N
108	2	0	5	5	f	f	WorkflowTransition	\N	\N
109	3	0	5	4	f	f	WorkflowTransition	\N	\N
110	3	0	5	5	f	f	WorkflowTransition	\N	\N
111	4	0	5	4	f	f	WorkflowTransition	\N	\N
112	4	0	5	5	f	f	WorkflowTransition	\N	\N
113	5	0	5	4	f	f	WorkflowTransition	\N	\N
114	5	0	5	5	f	f	WorkflowTransition	\N	\N
115	6	0	5	4	f	f	WorkflowTransition	\N	\N
116	6	0	5	5	f	f	WorkflowTransition	\N	\N
117	7	0	5	4	f	f	WorkflowTransition	\N	\N
118	7	0	5	5	f	f	WorkflowTransition	\N	\N
119	8	0	5	4	f	f	WorkflowTransition	\N	\N
120	8	0	5	5	f	f	WorkflowTransition	\N	\N
121	9	0	5	4	f	f	WorkflowTransition	\N	\N
122	9	0	5	5	f	f	WorkflowTransition	\N	\N
123	10	0	5	4	f	f	WorkflowTransition	\N	\N
124	10	0	5	5	f	f	WorkflowTransition	\N	\N
125	11	0	5	4	f	f	WorkflowTransition	\N	\N
126	11	0	5	5	f	f	WorkflowTransition	\N	\N
127	12	0	5	4	f	f	WorkflowTransition	\N	\N
128	12	0	5	5	f	f	WorkflowTransition	\N	\N
129	13	0	5	4	f	f	WorkflowTransition	\N	\N
130	13	0	5	5	f	f	WorkflowTransition	\N	\N
131	1	1	2	4	f	f	WorkflowTransition	\N	\N
132	1	1	2	5	f	f	WorkflowTransition	\N	\N
133	2	1	2	4	f	f	WorkflowTransition	\N	\N
134	2	1	2	5	f	f	WorkflowTransition	\N	\N
135	3	1	2	4	f	f	WorkflowTransition	\N	\N
136	3	1	2	5	f	f	WorkflowTransition	\N	\N
137	4	1	2	4	f	f	WorkflowTransition	\N	\N
138	4	1	2	5	f	f	WorkflowTransition	\N	\N
139	5	1	2	4	f	f	WorkflowTransition	\N	\N
140	5	1	2	5	f	f	WorkflowTransition	\N	\N
141	6	1	2	4	f	f	WorkflowTransition	\N	\N
142	6	1	2	5	f	f	WorkflowTransition	\N	\N
143	7	1	2	4	f	f	WorkflowTransition	\N	\N
144	7	1	2	5	f	f	WorkflowTransition	\N	\N
145	8	1	2	4	f	f	WorkflowTransition	\N	\N
146	8	1	2	5	f	f	WorkflowTransition	\N	\N
147	9	1	2	4	f	f	WorkflowTransition	\N	\N
148	9	1	2	5	f	f	WorkflowTransition	\N	\N
149	10	1	2	4	f	f	WorkflowTransition	\N	\N
150	10	1	2	5	f	f	WorkflowTransition	\N	\N
151	11	1	2	4	f	f	WorkflowTransition	\N	\N
152	11	1	2	5	f	f	WorkflowTransition	\N	\N
153	12	1	2	4	f	f	WorkflowTransition	\N	\N
154	12	1	2	5	f	f	WorkflowTransition	\N	\N
155	13	1	2	4	f	f	WorkflowTransition	\N	\N
156	13	1	2	5	f	f	WorkflowTransition	\N	\N
157	1	1	2	4	t	t	WorkflowTransition	\N	\N
158	1	1	2	5	t	t	WorkflowTransition	\N	\N
159	2	1	2	4	t	t	WorkflowTransition	\N	\N
160	2	1	2	5	t	t	WorkflowTransition	\N	\N
161	3	1	2	4	t	t	WorkflowTransition	\N	\N
162	3	1	2	5	t	t	WorkflowTransition	\N	\N
163	4	1	2	4	t	t	WorkflowTransition	\N	\N
164	4	1	2	5	t	t	WorkflowTransition	\N	\N
165	5	1	2	4	t	t	WorkflowTransition	\N	\N
166	5	1	2	5	t	t	WorkflowTransition	\N	\N
167	6	1	2	4	t	t	WorkflowTransition	\N	\N
168	6	1	2	5	t	t	WorkflowTransition	\N	\N
169	7	1	2	4	t	t	WorkflowTransition	\N	\N
170	7	1	2	5	t	t	WorkflowTransition	\N	\N
171	8	1	2	4	t	t	WorkflowTransition	\N	\N
172	8	1	2	5	t	t	WorkflowTransition	\N	\N
173	9	1	2	4	t	t	WorkflowTransition	\N	\N
174	9	1	2	5	t	t	WorkflowTransition	\N	\N
175	10	1	2	4	t	t	WorkflowTransition	\N	\N
176	10	1	2	5	t	t	WorkflowTransition	\N	\N
177	11	1	2	4	t	t	WorkflowTransition	\N	\N
178	11	1	2	5	t	t	WorkflowTransition	\N	\N
179	12	1	2	4	t	t	WorkflowTransition	\N	\N
180	12	1	2	5	t	t	WorkflowTransition	\N	\N
181	13	1	2	4	t	t	WorkflowTransition	\N	\N
182	13	1	2	5	t	t	WorkflowTransition	\N	\N
183	1	1	3	4	f	f	WorkflowTransition	\N	\N
184	1	1	3	5	f	f	WorkflowTransition	\N	\N
185	2	1	3	4	f	f	WorkflowTransition	\N	\N
186	2	1	3	5	f	f	WorkflowTransition	\N	\N
187	3	1	3	4	f	f	WorkflowTransition	\N	\N
188	3	1	3	5	f	f	WorkflowTransition	\N	\N
189	4	1	3	4	f	f	WorkflowTransition	\N	\N
190	4	1	3	5	f	f	WorkflowTransition	\N	\N
191	5	1	3	4	f	f	WorkflowTransition	\N	\N
192	5	1	3	5	f	f	WorkflowTransition	\N	\N
193	6	1	3	4	f	f	WorkflowTransition	\N	\N
194	6	1	3	5	f	f	WorkflowTransition	\N	\N
195	7	1	3	4	f	f	WorkflowTransition	\N	\N
196	7	1	3	5	f	f	WorkflowTransition	\N	\N
197	8	1	3	4	f	f	WorkflowTransition	\N	\N
198	8	1	3	5	f	f	WorkflowTransition	\N	\N
199	9	1	3	4	f	f	WorkflowTransition	\N	\N
200	9	1	3	5	f	f	WorkflowTransition	\N	\N
201	10	1	3	4	f	f	WorkflowTransition	\N	\N
202	10	1	3	5	f	f	WorkflowTransition	\N	\N
203	11	1	3	4	f	f	WorkflowTransition	\N	\N
204	11	1	3	5	f	f	WorkflowTransition	\N	\N
205	12	1	3	4	f	f	WorkflowTransition	\N	\N
206	12	1	3	5	f	f	WorkflowTransition	\N	\N
207	13	1	3	4	f	f	WorkflowTransition	\N	\N
208	13	1	3	5	f	f	WorkflowTransition	\N	\N
209	1	1	3	4	t	t	WorkflowTransition	\N	\N
210	1	1	3	5	t	t	WorkflowTransition	\N	\N
211	2	1	3	4	t	t	WorkflowTransition	\N	\N
212	2	1	3	5	t	t	WorkflowTransition	\N	\N
213	3	1	3	4	t	t	WorkflowTransition	\N	\N
214	3	1	3	5	t	t	WorkflowTransition	\N	\N
215	4	1	3	4	t	t	WorkflowTransition	\N	\N
216	4	1	3	5	t	t	WorkflowTransition	\N	\N
217	5	1	3	4	t	t	WorkflowTransition	\N	\N
218	5	1	3	5	t	t	WorkflowTransition	\N	\N
219	6	1	3	4	t	t	WorkflowTransition	\N	\N
220	6	1	3	5	t	t	WorkflowTransition	\N	\N
221	7	1	3	4	t	t	WorkflowTransition	\N	\N
222	7	1	3	5	t	t	WorkflowTransition	\N	\N
223	8	1	3	4	t	t	WorkflowTransition	\N	\N
224	8	1	3	5	t	t	WorkflowTransition	\N	\N
225	9	1	3	4	t	t	WorkflowTransition	\N	\N
226	9	1	3	5	t	t	WorkflowTransition	\N	\N
227	10	1	3	4	t	t	WorkflowTransition	\N	\N
228	10	1	3	5	t	t	WorkflowTransition	\N	\N
229	11	1	3	4	t	t	WorkflowTransition	\N	\N
230	11	1	3	5	t	t	WorkflowTransition	\N	\N
231	12	1	3	4	t	t	WorkflowTransition	\N	\N
232	12	1	3	5	t	t	WorkflowTransition	\N	\N
233	13	1	3	4	t	t	WorkflowTransition	\N	\N
234	13	1	3	5	t	t	WorkflowTransition	\N	\N
235	1	1	4	4	f	f	WorkflowTransition	\N	\N
236	1	1	4	5	f	f	WorkflowTransition	\N	\N
237	2	1	4	4	f	f	WorkflowTransition	\N	\N
238	2	1	4	5	f	f	WorkflowTransition	\N	\N
239	3	1	4	4	f	f	WorkflowTransition	\N	\N
240	3	1	4	5	f	f	WorkflowTransition	\N	\N
241	4	1	4	4	f	f	WorkflowTransition	\N	\N
242	4	1	4	5	f	f	WorkflowTransition	\N	\N
243	5	1	4	4	f	f	WorkflowTransition	\N	\N
244	5	1	4	5	f	f	WorkflowTransition	\N	\N
245	6	1	4	4	f	f	WorkflowTransition	\N	\N
246	6	1	4	5	f	f	WorkflowTransition	\N	\N
247	7	1	4	4	f	f	WorkflowTransition	\N	\N
248	7	1	4	5	f	f	WorkflowTransition	\N	\N
249	8	1	4	4	f	f	WorkflowTransition	\N	\N
250	8	1	4	5	f	f	WorkflowTransition	\N	\N
251	9	1	4	4	f	f	WorkflowTransition	\N	\N
252	9	1	4	5	f	f	WorkflowTransition	\N	\N
253	10	1	4	4	f	f	WorkflowTransition	\N	\N
254	10	1	4	5	f	f	WorkflowTransition	\N	\N
255	11	1	4	4	f	f	WorkflowTransition	\N	\N
256	11	1	4	5	f	f	WorkflowTransition	\N	\N
257	12	1	4	4	f	f	WorkflowTransition	\N	\N
258	12	1	4	5	f	f	WorkflowTransition	\N	\N
259	13	1	4	4	f	f	WorkflowTransition	\N	\N
260	13	1	4	5	f	f	WorkflowTransition	\N	\N
261	1	1	4	4	t	t	WorkflowTransition	\N	\N
262	1	1	4	5	t	t	WorkflowTransition	\N	\N
263	2	1	4	4	t	t	WorkflowTransition	\N	\N
264	2	1	4	5	t	t	WorkflowTransition	\N	\N
265	3	1	4	4	t	t	WorkflowTransition	\N	\N
266	3	1	4	5	t	t	WorkflowTransition	\N	\N
267	4	1	4	4	t	t	WorkflowTransition	\N	\N
268	4	1	4	5	t	t	WorkflowTransition	\N	\N
269	5	1	4	4	t	t	WorkflowTransition	\N	\N
270	5	1	4	5	t	t	WorkflowTransition	\N	\N
271	6	1	4	4	t	t	WorkflowTransition	\N	\N
272	6	1	4	5	t	t	WorkflowTransition	\N	\N
273	7	1	4	4	t	t	WorkflowTransition	\N	\N
274	7	1	4	5	t	t	WorkflowTransition	\N	\N
275	8	1	4	4	t	t	WorkflowTransition	\N	\N
276	8	1	4	5	t	t	WorkflowTransition	\N	\N
277	9	1	4	4	t	t	WorkflowTransition	\N	\N
278	9	1	4	5	t	t	WorkflowTransition	\N	\N
279	10	1	4	4	t	t	WorkflowTransition	\N	\N
280	10	1	4	5	t	t	WorkflowTransition	\N	\N
281	11	1	4	4	t	t	WorkflowTransition	\N	\N
282	11	1	4	5	t	t	WorkflowTransition	\N	\N
283	12	1	4	4	t	t	WorkflowTransition	\N	\N
284	12	1	4	5	t	t	WorkflowTransition	\N	\N
285	13	1	4	4	t	t	WorkflowTransition	\N	\N
286	13	1	4	5	t	t	WorkflowTransition	\N	\N
287	1	1	5	4	f	f	WorkflowTransition	\N	\N
288	1	1	5	5	f	f	WorkflowTransition	\N	\N
289	2	1	5	4	f	f	WorkflowTransition	\N	\N
290	2	1	5	5	f	f	WorkflowTransition	\N	\N
291	3	1	5	4	f	f	WorkflowTransition	\N	\N
292	3	1	5	5	f	f	WorkflowTransition	\N	\N
293	4	1	5	4	f	f	WorkflowTransition	\N	\N
294	4	1	5	5	f	f	WorkflowTransition	\N	\N
295	5	1	5	4	f	f	WorkflowTransition	\N	\N
296	5	1	5	5	f	f	WorkflowTransition	\N	\N
297	6	1	5	4	f	f	WorkflowTransition	\N	\N
298	6	1	5	5	f	f	WorkflowTransition	\N	\N
299	7	1	5	4	f	f	WorkflowTransition	\N	\N
300	7	1	5	5	f	f	WorkflowTransition	\N	\N
301	8	1	5	4	f	f	WorkflowTransition	\N	\N
302	8	1	5	5	f	f	WorkflowTransition	\N	\N
303	9	1	5	4	f	f	WorkflowTransition	\N	\N
304	9	1	5	5	f	f	WorkflowTransition	\N	\N
305	10	1	5	4	f	f	WorkflowTransition	\N	\N
306	10	1	5	5	f	f	WorkflowTransition	\N	\N
307	11	1	5	4	f	f	WorkflowTransition	\N	\N
308	11	1	5	5	f	f	WorkflowTransition	\N	\N
309	12	1	5	4	f	f	WorkflowTransition	\N	\N
310	12	1	5	5	f	f	WorkflowTransition	\N	\N
311	13	1	5	4	f	f	WorkflowTransition	\N	\N
312	13	1	5	5	f	f	WorkflowTransition	\N	\N
313	1	1	5	4	t	t	WorkflowTransition	\N	\N
314	1	1	5	5	t	t	WorkflowTransition	\N	\N
315	2	1	5	4	t	t	WorkflowTransition	\N	\N
316	2	1	5	5	t	t	WorkflowTransition	\N	\N
317	3	1	5	4	t	t	WorkflowTransition	\N	\N
318	3	1	5	5	t	t	WorkflowTransition	\N	\N
319	4	1	5	4	t	t	WorkflowTransition	\N	\N
320	4	1	5	5	t	t	WorkflowTransition	\N	\N
321	5	1	5	4	t	t	WorkflowTransition	\N	\N
322	5	1	5	5	t	t	WorkflowTransition	\N	\N
323	6	1	5	4	t	t	WorkflowTransition	\N	\N
324	6	1	5	5	t	t	WorkflowTransition	\N	\N
325	7	1	5	4	t	t	WorkflowTransition	\N	\N
326	7	1	5	5	t	t	WorkflowTransition	\N	\N
327	8	1	5	4	t	t	WorkflowTransition	\N	\N
328	8	1	5	5	t	t	WorkflowTransition	\N	\N
329	9	1	5	4	t	t	WorkflowTransition	\N	\N
330	9	1	5	5	t	t	WorkflowTransition	\N	\N
331	10	1	5	4	t	t	WorkflowTransition	\N	\N
332	10	1	5	5	t	t	WorkflowTransition	\N	\N
333	11	1	5	4	t	t	WorkflowTransition	\N	\N
334	11	1	5	5	t	t	WorkflowTransition	\N	\N
335	12	1	5	4	t	t	WorkflowTransition	\N	\N
336	12	1	5	5	t	t	WorkflowTransition	\N	\N
337	13	1	5	4	t	t	WorkflowTransition	\N	\N
338	13	1	5	5	t	t	WorkflowTransition	\N	\N
339	1	2	1	4	f	f	WorkflowTransition	\N	\N
340	1	2	1	5	f	f	WorkflowTransition	\N	\N
341	2	2	1	4	f	f	WorkflowTransition	\N	\N
342	2	2	1	5	f	f	WorkflowTransition	\N	\N
343	3	2	1	4	f	f	WorkflowTransition	\N	\N
344	3	2	1	5	f	f	WorkflowTransition	\N	\N
345	4	2	1	4	f	f	WorkflowTransition	\N	\N
346	4	2	1	5	f	f	WorkflowTransition	\N	\N
347	5	2	1	4	f	f	WorkflowTransition	\N	\N
348	5	2	1	5	f	f	WorkflowTransition	\N	\N
349	6	2	1	4	f	f	WorkflowTransition	\N	\N
350	6	2	1	5	f	f	WorkflowTransition	\N	\N
351	7	2	1	4	f	f	WorkflowTransition	\N	\N
352	7	2	1	5	f	f	WorkflowTransition	\N	\N
353	8	2	1	4	f	f	WorkflowTransition	\N	\N
354	8	2	1	5	f	f	WorkflowTransition	\N	\N
355	9	2	1	4	f	f	WorkflowTransition	\N	\N
356	9	2	1	5	f	f	WorkflowTransition	\N	\N
357	10	2	1	4	f	f	WorkflowTransition	\N	\N
358	10	2	1	5	f	f	WorkflowTransition	\N	\N
359	11	2	1	4	f	f	WorkflowTransition	\N	\N
360	11	2	1	5	f	f	WorkflowTransition	\N	\N
361	12	2	1	4	f	f	WorkflowTransition	\N	\N
362	12	2	1	5	f	f	WorkflowTransition	\N	\N
363	13	2	1	4	f	f	WorkflowTransition	\N	\N
364	13	2	1	5	f	f	WorkflowTransition	\N	\N
365	1	2	1	4	t	t	WorkflowTransition	\N	\N
366	1	2	1	5	t	t	WorkflowTransition	\N	\N
367	2	2	1	4	t	t	WorkflowTransition	\N	\N
368	2	2	1	5	t	t	WorkflowTransition	\N	\N
369	3	2	1	4	t	t	WorkflowTransition	\N	\N
370	3	2	1	5	t	t	WorkflowTransition	\N	\N
371	4	2	1	4	t	t	WorkflowTransition	\N	\N
372	4	2	1	5	t	t	WorkflowTransition	\N	\N
373	5	2	1	4	t	t	WorkflowTransition	\N	\N
374	5	2	1	5	t	t	WorkflowTransition	\N	\N
375	6	2	1	4	t	t	WorkflowTransition	\N	\N
376	6	2	1	5	t	t	WorkflowTransition	\N	\N
377	7	2	1	4	t	t	WorkflowTransition	\N	\N
378	7	2	1	5	t	t	WorkflowTransition	\N	\N
379	8	2	1	4	t	t	WorkflowTransition	\N	\N
380	8	2	1	5	t	t	WorkflowTransition	\N	\N
381	9	2	1	4	t	t	WorkflowTransition	\N	\N
382	9	2	1	5	t	t	WorkflowTransition	\N	\N
383	10	2	1	4	t	t	WorkflowTransition	\N	\N
384	10	2	1	5	t	t	WorkflowTransition	\N	\N
385	11	2	1	4	t	t	WorkflowTransition	\N	\N
386	11	2	1	5	t	t	WorkflowTransition	\N	\N
387	12	2	1	4	t	t	WorkflowTransition	\N	\N
388	12	2	1	5	t	t	WorkflowTransition	\N	\N
389	13	2	1	4	t	t	WorkflowTransition	\N	\N
390	13	2	1	5	t	t	WorkflowTransition	\N	\N
391	1	2	3	4	f	f	WorkflowTransition	\N	\N
392	1	2	3	5	f	f	WorkflowTransition	\N	\N
393	2	2	3	4	f	f	WorkflowTransition	\N	\N
394	2	2	3	5	f	f	WorkflowTransition	\N	\N
395	3	2	3	4	f	f	WorkflowTransition	\N	\N
396	3	2	3	5	f	f	WorkflowTransition	\N	\N
397	4	2	3	4	f	f	WorkflowTransition	\N	\N
398	4	2	3	5	f	f	WorkflowTransition	\N	\N
399	5	2	3	4	f	f	WorkflowTransition	\N	\N
400	5	2	3	5	f	f	WorkflowTransition	\N	\N
401	6	2	3	4	f	f	WorkflowTransition	\N	\N
402	6	2	3	5	f	f	WorkflowTransition	\N	\N
403	7	2	3	4	f	f	WorkflowTransition	\N	\N
404	7	2	3	5	f	f	WorkflowTransition	\N	\N
405	8	2	3	4	f	f	WorkflowTransition	\N	\N
406	8	2	3	5	f	f	WorkflowTransition	\N	\N
407	9	2	3	4	f	f	WorkflowTransition	\N	\N
408	9	2	3	5	f	f	WorkflowTransition	\N	\N
409	10	2	3	4	f	f	WorkflowTransition	\N	\N
410	10	2	3	5	f	f	WorkflowTransition	\N	\N
411	11	2	3	4	f	f	WorkflowTransition	\N	\N
412	11	2	3	5	f	f	WorkflowTransition	\N	\N
413	12	2	3	4	f	f	WorkflowTransition	\N	\N
414	12	2	3	5	f	f	WorkflowTransition	\N	\N
415	13	2	3	4	f	f	WorkflowTransition	\N	\N
416	13	2	3	5	f	f	WorkflowTransition	\N	\N
417	1	2	3	4	t	t	WorkflowTransition	\N	\N
418	1	2	3	5	t	t	WorkflowTransition	\N	\N
419	2	2	3	4	t	t	WorkflowTransition	\N	\N
420	2	2	3	5	t	t	WorkflowTransition	\N	\N
421	3	2	3	4	t	t	WorkflowTransition	\N	\N
422	3	2	3	5	t	t	WorkflowTransition	\N	\N
423	4	2	3	4	t	t	WorkflowTransition	\N	\N
424	4	2	3	5	t	t	WorkflowTransition	\N	\N
425	5	2	3	4	t	t	WorkflowTransition	\N	\N
426	5	2	3	5	t	t	WorkflowTransition	\N	\N
427	6	2	3	4	t	t	WorkflowTransition	\N	\N
428	6	2	3	5	t	t	WorkflowTransition	\N	\N
429	7	2	3	4	t	t	WorkflowTransition	\N	\N
430	7	2	3	5	t	t	WorkflowTransition	\N	\N
431	8	2	3	4	t	t	WorkflowTransition	\N	\N
432	8	2	3	5	t	t	WorkflowTransition	\N	\N
433	9	2	3	4	t	t	WorkflowTransition	\N	\N
434	9	2	3	5	t	t	WorkflowTransition	\N	\N
435	10	2	3	4	t	t	WorkflowTransition	\N	\N
436	10	2	3	5	t	t	WorkflowTransition	\N	\N
437	11	2	3	4	t	t	WorkflowTransition	\N	\N
438	11	2	3	5	t	t	WorkflowTransition	\N	\N
439	12	2	3	4	t	t	WorkflowTransition	\N	\N
440	12	2	3	5	t	t	WorkflowTransition	\N	\N
441	13	2	3	4	t	t	WorkflowTransition	\N	\N
442	13	2	3	5	t	t	WorkflowTransition	\N	\N
443	1	2	4	4	f	f	WorkflowTransition	\N	\N
444	1	2	4	5	f	f	WorkflowTransition	\N	\N
445	2	2	4	4	f	f	WorkflowTransition	\N	\N
446	2	2	4	5	f	f	WorkflowTransition	\N	\N
447	3	2	4	4	f	f	WorkflowTransition	\N	\N
448	3	2	4	5	f	f	WorkflowTransition	\N	\N
449	4	2	4	4	f	f	WorkflowTransition	\N	\N
450	4	2	4	5	f	f	WorkflowTransition	\N	\N
451	5	2	4	4	f	f	WorkflowTransition	\N	\N
452	5	2	4	5	f	f	WorkflowTransition	\N	\N
453	6	2	4	4	f	f	WorkflowTransition	\N	\N
454	6	2	4	5	f	f	WorkflowTransition	\N	\N
455	7	2	4	4	f	f	WorkflowTransition	\N	\N
456	7	2	4	5	f	f	WorkflowTransition	\N	\N
457	8	2	4	4	f	f	WorkflowTransition	\N	\N
458	8	2	4	5	f	f	WorkflowTransition	\N	\N
459	9	2	4	4	f	f	WorkflowTransition	\N	\N
460	9	2	4	5	f	f	WorkflowTransition	\N	\N
461	10	2	4	4	f	f	WorkflowTransition	\N	\N
462	10	2	4	5	f	f	WorkflowTransition	\N	\N
463	11	2	4	4	f	f	WorkflowTransition	\N	\N
464	11	2	4	5	f	f	WorkflowTransition	\N	\N
465	12	2	4	4	f	f	WorkflowTransition	\N	\N
466	12	2	4	5	f	f	WorkflowTransition	\N	\N
467	13	2	4	4	f	f	WorkflowTransition	\N	\N
468	13	2	4	5	f	f	WorkflowTransition	\N	\N
469	1	2	4	4	t	t	WorkflowTransition	\N	\N
470	1	2	4	5	t	t	WorkflowTransition	\N	\N
471	2	2	4	4	t	t	WorkflowTransition	\N	\N
472	2	2	4	5	t	t	WorkflowTransition	\N	\N
473	3	2	4	4	t	t	WorkflowTransition	\N	\N
474	3	2	4	5	t	t	WorkflowTransition	\N	\N
475	4	2	4	4	t	t	WorkflowTransition	\N	\N
476	4	2	4	5	t	t	WorkflowTransition	\N	\N
477	5	2	4	4	t	t	WorkflowTransition	\N	\N
478	5	2	4	5	t	t	WorkflowTransition	\N	\N
479	6	2	4	4	t	t	WorkflowTransition	\N	\N
480	6	2	4	5	t	t	WorkflowTransition	\N	\N
481	7	2	4	4	t	t	WorkflowTransition	\N	\N
482	7	2	4	5	t	t	WorkflowTransition	\N	\N
483	8	2	4	4	t	t	WorkflowTransition	\N	\N
484	8	2	4	5	t	t	WorkflowTransition	\N	\N
485	9	2	4	4	t	t	WorkflowTransition	\N	\N
486	9	2	4	5	t	t	WorkflowTransition	\N	\N
487	10	2	4	4	t	t	WorkflowTransition	\N	\N
488	10	2	4	5	t	t	WorkflowTransition	\N	\N
489	11	2	4	4	t	t	WorkflowTransition	\N	\N
490	11	2	4	5	t	t	WorkflowTransition	\N	\N
491	12	2	4	4	t	t	WorkflowTransition	\N	\N
492	12	2	4	5	t	t	WorkflowTransition	\N	\N
493	13	2	4	4	t	t	WorkflowTransition	\N	\N
494	13	2	4	5	t	t	WorkflowTransition	\N	\N
495	1	2	5	4	f	f	WorkflowTransition	\N	\N
496	1	2	5	5	f	f	WorkflowTransition	\N	\N
497	2	2	5	4	f	f	WorkflowTransition	\N	\N
498	2	2	5	5	f	f	WorkflowTransition	\N	\N
499	3	2	5	4	f	f	WorkflowTransition	\N	\N
500	3	2	5	5	f	f	WorkflowTransition	\N	\N
501	4	2	5	4	f	f	WorkflowTransition	\N	\N
502	4	2	5	5	f	f	WorkflowTransition	\N	\N
503	5	2	5	4	f	f	WorkflowTransition	\N	\N
504	5	2	5	5	f	f	WorkflowTransition	\N	\N
505	6	2	5	4	f	f	WorkflowTransition	\N	\N
506	6	2	5	5	f	f	WorkflowTransition	\N	\N
507	7	2	5	4	f	f	WorkflowTransition	\N	\N
508	7	2	5	5	f	f	WorkflowTransition	\N	\N
509	8	2	5	4	f	f	WorkflowTransition	\N	\N
510	8	2	5	5	f	f	WorkflowTransition	\N	\N
511	9	2	5	4	f	f	WorkflowTransition	\N	\N
512	9	2	5	5	f	f	WorkflowTransition	\N	\N
513	10	2	5	4	f	f	WorkflowTransition	\N	\N
514	10	2	5	5	f	f	WorkflowTransition	\N	\N
515	11	2	5	4	f	f	WorkflowTransition	\N	\N
516	11	2	5	5	f	f	WorkflowTransition	\N	\N
517	12	2	5	4	f	f	WorkflowTransition	\N	\N
518	12	2	5	5	f	f	WorkflowTransition	\N	\N
519	13	2	5	4	f	f	WorkflowTransition	\N	\N
520	13	2	5	5	f	f	WorkflowTransition	\N	\N
521	1	2	5	4	t	t	WorkflowTransition	\N	\N
522	1	2	5	5	t	t	WorkflowTransition	\N	\N
523	2	2	5	4	t	t	WorkflowTransition	\N	\N
524	2	2	5	5	t	t	WorkflowTransition	\N	\N
525	3	2	5	4	t	t	WorkflowTransition	\N	\N
526	3	2	5	5	t	t	WorkflowTransition	\N	\N
527	4	2	5	4	t	t	WorkflowTransition	\N	\N
528	4	2	5	5	t	t	WorkflowTransition	\N	\N
529	5	2	5	4	t	t	WorkflowTransition	\N	\N
530	5	2	5	5	t	t	WorkflowTransition	\N	\N
531	6	2	5	4	t	t	WorkflowTransition	\N	\N
532	6	2	5	5	t	t	WorkflowTransition	\N	\N
533	7	2	5	4	t	t	WorkflowTransition	\N	\N
534	7	2	5	5	t	t	WorkflowTransition	\N	\N
535	8	2	5	4	t	t	WorkflowTransition	\N	\N
536	8	2	5	5	t	t	WorkflowTransition	\N	\N
537	9	2	5	4	t	t	WorkflowTransition	\N	\N
538	9	2	5	5	t	t	WorkflowTransition	\N	\N
539	10	2	5	4	t	t	WorkflowTransition	\N	\N
540	10	2	5	5	t	t	WorkflowTransition	\N	\N
541	11	2	5	4	t	t	WorkflowTransition	\N	\N
542	11	2	5	5	t	t	WorkflowTransition	\N	\N
543	12	2	5	4	t	t	WorkflowTransition	\N	\N
544	12	2	5	5	t	t	WorkflowTransition	\N	\N
545	13	2	5	4	t	t	WorkflowTransition	\N	\N
546	13	2	5	5	t	t	WorkflowTransition	\N	\N
547	1	3	1	4	f	f	WorkflowTransition	\N	\N
548	1	3	1	5	f	f	WorkflowTransition	\N	\N
549	2	3	1	4	f	f	WorkflowTransition	\N	\N
550	2	3	1	5	f	f	WorkflowTransition	\N	\N
551	3	3	1	4	f	f	WorkflowTransition	\N	\N
552	3	3	1	5	f	f	WorkflowTransition	\N	\N
553	4	3	1	4	f	f	WorkflowTransition	\N	\N
554	4	3	1	5	f	f	WorkflowTransition	\N	\N
555	5	3	1	4	f	f	WorkflowTransition	\N	\N
556	5	3	1	5	f	f	WorkflowTransition	\N	\N
557	6	3	1	4	f	f	WorkflowTransition	\N	\N
558	6	3	1	5	f	f	WorkflowTransition	\N	\N
559	7	3	1	4	f	f	WorkflowTransition	\N	\N
560	7	3	1	5	f	f	WorkflowTransition	\N	\N
561	8	3	1	4	f	f	WorkflowTransition	\N	\N
562	8	3	1	5	f	f	WorkflowTransition	\N	\N
563	9	3	1	4	f	f	WorkflowTransition	\N	\N
564	9	3	1	5	f	f	WorkflowTransition	\N	\N
565	10	3	1	4	f	f	WorkflowTransition	\N	\N
566	10	3	1	5	f	f	WorkflowTransition	\N	\N
567	11	3	1	4	f	f	WorkflowTransition	\N	\N
568	11	3	1	5	f	f	WorkflowTransition	\N	\N
569	12	3	1	4	f	f	WorkflowTransition	\N	\N
570	12	3	1	5	f	f	WorkflowTransition	\N	\N
571	13	3	1	4	f	f	WorkflowTransition	\N	\N
572	13	3	1	5	f	f	WorkflowTransition	\N	\N
573	1	3	1	4	t	t	WorkflowTransition	\N	\N
574	1	3	1	5	t	t	WorkflowTransition	\N	\N
575	2	3	1	4	t	t	WorkflowTransition	\N	\N
576	2	3	1	5	t	t	WorkflowTransition	\N	\N
577	3	3	1	4	t	t	WorkflowTransition	\N	\N
578	3	3	1	5	t	t	WorkflowTransition	\N	\N
579	4	3	1	4	t	t	WorkflowTransition	\N	\N
580	4	3	1	5	t	t	WorkflowTransition	\N	\N
581	5	3	1	4	t	t	WorkflowTransition	\N	\N
582	5	3	1	5	t	t	WorkflowTransition	\N	\N
583	6	3	1	4	t	t	WorkflowTransition	\N	\N
584	6	3	1	5	t	t	WorkflowTransition	\N	\N
585	7	3	1	4	t	t	WorkflowTransition	\N	\N
586	7	3	1	5	t	t	WorkflowTransition	\N	\N
587	8	3	1	4	t	t	WorkflowTransition	\N	\N
588	8	3	1	5	t	t	WorkflowTransition	\N	\N
589	9	3	1	4	t	t	WorkflowTransition	\N	\N
590	9	3	1	5	t	t	WorkflowTransition	\N	\N
591	10	3	1	4	t	t	WorkflowTransition	\N	\N
592	10	3	1	5	t	t	WorkflowTransition	\N	\N
593	11	3	1	4	t	t	WorkflowTransition	\N	\N
594	11	3	1	5	t	t	WorkflowTransition	\N	\N
595	12	3	1	4	t	t	WorkflowTransition	\N	\N
596	12	3	1	5	t	t	WorkflowTransition	\N	\N
597	13	3	1	4	t	t	WorkflowTransition	\N	\N
598	13	3	1	5	t	t	WorkflowTransition	\N	\N
599	1	3	2	4	f	f	WorkflowTransition	\N	\N
600	1	3	2	5	f	f	WorkflowTransition	\N	\N
601	2	3	2	4	f	f	WorkflowTransition	\N	\N
602	2	3	2	5	f	f	WorkflowTransition	\N	\N
603	3	3	2	4	f	f	WorkflowTransition	\N	\N
604	3	3	2	5	f	f	WorkflowTransition	\N	\N
605	4	3	2	4	f	f	WorkflowTransition	\N	\N
606	4	3	2	5	f	f	WorkflowTransition	\N	\N
607	5	3	2	4	f	f	WorkflowTransition	\N	\N
608	5	3	2	5	f	f	WorkflowTransition	\N	\N
609	6	3	2	4	f	f	WorkflowTransition	\N	\N
610	6	3	2	5	f	f	WorkflowTransition	\N	\N
611	7	3	2	4	f	f	WorkflowTransition	\N	\N
612	7	3	2	5	f	f	WorkflowTransition	\N	\N
613	8	3	2	4	f	f	WorkflowTransition	\N	\N
614	8	3	2	5	f	f	WorkflowTransition	\N	\N
615	9	3	2	4	f	f	WorkflowTransition	\N	\N
616	9	3	2	5	f	f	WorkflowTransition	\N	\N
617	10	3	2	4	f	f	WorkflowTransition	\N	\N
618	10	3	2	5	f	f	WorkflowTransition	\N	\N
619	11	3	2	4	f	f	WorkflowTransition	\N	\N
620	11	3	2	5	f	f	WorkflowTransition	\N	\N
621	12	3	2	4	f	f	WorkflowTransition	\N	\N
622	12	3	2	5	f	f	WorkflowTransition	\N	\N
623	13	3	2	4	f	f	WorkflowTransition	\N	\N
624	13	3	2	5	f	f	WorkflowTransition	\N	\N
625	1	3	2	4	t	t	WorkflowTransition	\N	\N
626	1	3	2	5	t	t	WorkflowTransition	\N	\N
627	2	3	2	4	t	t	WorkflowTransition	\N	\N
628	2	3	2	5	t	t	WorkflowTransition	\N	\N
629	3	3	2	4	t	t	WorkflowTransition	\N	\N
630	3	3	2	5	t	t	WorkflowTransition	\N	\N
631	4	3	2	4	t	t	WorkflowTransition	\N	\N
632	4	3	2	5	t	t	WorkflowTransition	\N	\N
633	5	3	2	4	t	t	WorkflowTransition	\N	\N
634	5	3	2	5	t	t	WorkflowTransition	\N	\N
635	6	3	2	4	t	t	WorkflowTransition	\N	\N
636	6	3	2	5	t	t	WorkflowTransition	\N	\N
637	7	3	2	4	t	t	WorkflowTransition	\N	\N
638	7	3	2	5	t	t	WorkflowTransition	\N	\N
639	8	3	2	4	t	t	WorkflowTransition	\N	\N
640	8	3	2	5	t	t	WorkflowTransition	\N	\N
641	9	3	2	4	t	t	WorkflowTransition	\N	\N
642	9	3	2	5	t	t	WorkflowTransition	\N	\N
643	10	3	2	4	t	t	WorkflowTransition	\N	\N
644	10	3	2	5	t	t	WorkflowTransition	\N	\N
645	11	3	2	4	t	t	WorkflowTransition	\N	\N
646	11	3	2	5	t	t	WorkflowTransition	\N	\N
647	12	3	2	4	t	t	WorkflowTransition	\N	\N
648	12	3	2	5	t	t	WorkflowTransition	\N	\N
649	13	3	2	4	t	t	WorkflowTransition	\N	\N
650	13	3	2	5	t	t	WorkflowTransition	\N	\N
651	1	3	4	4	f	f	WorkflowTransition	\N	\N
652	1	3	4	5	f	f	WorkflowTransition	\N	\N
653	2	3	4	4	f	f	WorkflowTransition	\N	\N
654	2	3	4	5	f	f	WorkflowTransition	\N	\N
655	3	3	4	4	f	f	WorkflowTransition	\N	\N
656	3	3	4	5	f	f	WorkflowTransition	\N	\N
657	4	3	4	4	f	f	WorkflowTransition	\N	\N
658	4	3	4	5	f	f	WorkflowTransition	\N	\N
659	5	3	4	4	f	f	WorkflowTransition	\N	\N
660	5	3	4	5	f	f	WorkflowTransition	\N	\N
661	6	3	4	4	f	f	WorkflowTransition	\N	\N
662	6	3	4	5	f	f	WorkflowTransition	\N	\N
663	7	3	4	4	f	f	WorkflowTransition	\N	\N
664	7	3	4	5	f	f	WorkflowTransition	\N	\N
665	8	3	4	4	f	f	WorkflowTransition	\N	\N
666	8	3	4	5	f	f	WorkflowTransition	\N	\N
667	9	3	4	4	f	f	WorkflowTransition	\N	\N
668	9	3	4	5	f	f	WorkflowTransition	\N	\N
669	10	3	4	4	f	f	WorkflowTransition	\N	\N
670	10	3	4	5	f	f	WorkflowTransition	\N	\N
671	11	3	4	4	f	f	WorkflowTransition	\N	\N
672	11	3	4	5	f	f	WorkflowTransition	\N	\N
673	12	3	4	4	f	f	WorkflowTransition	\N	\N
674	12	3	4	5	f	f	WorkflowTransition	\N	\N
675	13	3	4	4	f	f	WorkflowTransition	\N	\N
676	13	3	4	5	f	f	WorkflowTransition	\N	\N
677	1	3	4	4	t	t	WorkflowTransition	\N	\N
678	1	3	4	5	t	t	WorkflowTransition	\N	\N
679	2	3	4	4	t	t	WorkflowTransition	\N	\N
680	2	3	4	5	t	t	WorkflowTransition	\N	\N
681	3	3	4	4	t	t	WorkflowTransition	\N	\N
682	3	3	4	5	t	t	WorkflowTransition	\N	\N
683	4	3	4	4	t	t	WorkflowTransition	\N	\N
684	4	3	4	5	t	t	WorkflowTransition	\N	\N
685	5	3	4	4	t	t	WorkflowTransition	\N	\N
686	5	3	4	5	t	t	WorkflowTransition	\N	\N
687	6	3	4	4	t	t	WorkflowTransition	\N	\N
688	6	3	4	5	t	t	WorkflowTransition	\N	\N
689	7	3	4	4	t	t	WorkflowTransition	\N	\N
690	7	3	4	5	t	t	WorkflowTransition	\N	\N
691	8	3	4	4	t	t	WorkflowTransition	\N	\N
692	8	3	4	5	t	t	WorkflowTransition	\N	\N
693	9	3	4	4	t	t	WorkflowTransition	\N	\N
694	9	3	4	5	t	t	WorkflowTransition	\N	\N
695	10	3	4	4	t	t	WorkflowTransition	\N	\N
696	10	3	4	5	t	t	WorkflowTransition	\N	\N
697	11	3	4	4	t	t	WorkflowTransition	\N	\N
698	11	3	4	5	t	t	WorkflowTransition	\N	\N
699	12	3	4	4	t	t	WorkflowTransition	\N	\N
700	12	3	4	5	t	t	WorkflowTransition	\N	\N
701	13	3	4	4	t	t	WorkflowTransition	\N	\N
702	13	3	4	5	t	t	WorkflowTransition	\N	\N
703	1	3	5	4	f	f	WorkflowTransition	\N	\N
704	1	3	5	5	f	f	WorkflowTransition	\N	\N
705	2	3	5	4	f	f	WorkflowTransition	\N	\N
706	2	3	5	5	f	f	WorkflowTransition	\N	\N
707	3	3	5	4	f	f	WorkflowTransition	\N	\N
708	3	3	5	5	f	f	WorkflowTransition	\N	\N
709	4	3	5	4	f	f	WorkflowTransition	\N	\N
710	4	3	5	5	f	f	WorkflowTransition	\N	\N
711	5	3	5	4	f	f	WorkflowTransition	\N	\N
712	5	3	5	5	f	f	WorkflowTransition	\N	\N
713	6	3	5	4	f	f	WorkflowTransition	\N	\N
714	6	3	5	5	f	f	WorkflowTransition	\N	\N
715	7	3	5	4	f	f	WorkflowTransition	\N	\N
716	7	3	5	5	f	f	WorkflowTransition	\N	\N
717	8	3	5	4	f	f	WorkflowTransition	\N	\N
718	8	3	5	5	f	f	WorkflowTransition	\N	\N
719	9	3	5	4	f	f	WorkflowTransition	\N	\N
720	9	3	5	5	f	f	WorkflowTransition	\N	\N
721	10	3	5	4	f	f	WorkflowTransition	\N	\N
722	10	3	5	5	f	f	WorkflowTransition	\N	\N
723	11	3	5	4	f	f	WorkflowTransition	\N	\N
724	11	3	5	5	f	f	WorkflowTransition	\N	\N
725	12	3	5	4	f	f	WorkflowTransition	\N	\N
726	12	3	5	5	f	f	WorkflowTransition	\N	\N
727	13	3	5	4	f	f	WorkflowTransition	\N	\N
728	13	3	5	5	f	f	WorkflowTransition	\N	\N
729	1	3	5	4	t	t	WorkflowTransition	\N	\N
730	1	3	5	5	t	t	WorkflowTransition	\N	\N
731	2	3	5	4	t	t	WorkflowTransition	\N	\N
732	2	3	5	5	t	t	WorkflowTransition	\N	\N
733	3	3	5	4	t	t	WorkflowTransition	\N	\N
734	3	3	5	5	t	t	WorkflowTransition	\N	\N
735	4	3	5	4	t	t	WorkflowTransition	\N	\N
736	4	3	5	5	t	t	WorkflowTransition	\N	\N
737	5	3	5	4	t	t	WorkflowTransition	\N	\N
738	5	3	5	5	t	t	WorkflowTransition	\N	\N
739	6	3	5	4	t	t	WorkflowTransition	\N	\N
740	6	3	5	5	t	t	WorkflowTransition	\N	\N
741	7	3	5	4	t	t	WorkflowTransition	\N	\N
742	7	3	5	5	t	t	WorkflowTransition	\N	\N
743	8	3	5	4	t	t	WorkflowTransition	\N	\N
744	8	3	5	5	t	t	WorkflowTransition	\N	\N
745	9	3	5	4	t	t	WorkflowTransition	\N	\N
746	9	3	5	5	t	t	WorkflowTransition	\N	\N
747	10	3	5	4	t	t	WorkflowTransition	\N	\N
748	10	3	5	5	t	t	WorkflowTransition	\N	\N
749	11	3	5	4	t	t	WorkflowTransition	\N	\N
750	11	3	5	5	t	t	WorkflowTransition	\N	\N
751	12	3	5	4	t	t	WorkflowTransition	\N	\N
752	12	3	5	5	t	t	WorkflowTransition	\N	\N
753	13	3	5	4	t	t	WorkflowTransition	\N	\N
754	13	3	5	5	t	t	WorkflowTransition	\N	\N
755	1	4	1	4	f	f	WorkflowTransition	\N	\N
756	1	4	1	5	f	f	WorkflowTransition	\N	\N
757	2	4	1	4	f	f	WorkflowTransition	\N	\N
758	2	4	1	5	f	f	WorkflowTransition	\N	\N
759	3	4	1	4	f	f	WorkflowTransition	\N	\N
760	3	4	1	5	f	f	WorkflowTransition	\N	\N
761	4	4	1	4	f	f	WorkflowTransition	\N	\N
762	4	4	1	5	f	f	WorkflowTransition	\N	\N
763	5	4	1	4	f	f	WorkflowTransition	\N	\N
764	5	4	1	5	f	f	WorkflowTransition	\N	\N
765	6	4	1	4	f	f	WorkflowTransition	\N	\N
766	6	4	1	5	f	f	WorkflowTransition	\N	\N
767	7	4	1	4	f	f	WorkflowTransition	\N	\N
768	7	4	1	5	f	f	WorkflowTransition	\N	\N
769	8	4	1	4	f	f	WorkflowTransition	\N	\N
770	8	4	1	5	f	f	WorkflowTransition	\N	\N
771	9	4	1	4	f	f	WorkflowTransition	\N	\N
772	9	4	1	5	f	f	WorkflowTransition	\N	\N
773	10	4	1	4	f	f	WorkflowTransition	\N	\N
774	10	4	1	5	f	f	WorkflowTransition	\N	\N
775	11	4	1	4	f	f	WorkflowTransition	\N	\N
776	11	4	1	5	f	f	WorkflowTransition	\N	\N
777	12	4	1	4	f	f	WorkflowTransition	\N	\N
778	12	4	1	5	f	f	WorkflowTransition	\N	\N
779	13	4	1	4	f	f	WorkflowTransition	\N	\N
780	13	4	1	5	f	f	WorkflowTransition	\N	\N
781	1	4	1	4	t	t	WorkflowTransition	\N	\N
782	1	4	1	5	t	t	WorkflowTransition	\N	\N
783	2	4	1	4	t	t	WorkflowTransition	\N	\N
784	2	4	1	5	t	t	WorkflowTransition	\N	\N
785	3	4	1	4	t	t	WorkflowTransition	\N	\N
786	3	4	1	5	t	t	WorkflowTransition	\N	\N
787	4	4	1	4	t	t	WorkflowTransition	\N	\N
788	4	4	1	5	t	t	WorkflowTransition	\N	\N
789	5	4	1	4	t	t	WorkflowTransition	\N	\N
790	5	4	1	5	t	t	WorkflowTransition	\N	\N
791	6	4	1	4	t	t	WorkflowTransition	\N	\N
792	6	4	1	5	t	t	WorkflowTransition	\N	\N
793	7	4	1	4	t	t	WorkflowTransition	\N	\N
794	7	4	1	5	t	t	WorkflowTransition	\N	\N
795	8	4	1	4	t	t	WorkflowTransition	\N	\N
796	8	4	1	5	t	t	WorkflowTransition	\N	\N
797	9	4	1	4	t	t	WorkflowTransition	\N	\N
798	9	4	1	5	t	t	WorkflowTransition	\N	\N
799	10	4	1	4	t	t	WorkflowTransition	\N	\N
800	10	4	1	5	t	t	WorkflowTransition	\N	\N
801	11	4	1	4	t	t	WorkflowTransition	\N	\N
802	11	4	1	5	t	t	WorkflowTransition	\N	\N
803	12	4	1	4	t	t	WorkflowTransition	\N	\N
804	12	4	1	5	t	t	WorkflowTransition	\N	\N
805	13	4	1	4	t	t	WorkflowTransition	\N	\N
806	13	4	1	5	t	t	WorkflowTransition	\N	\N
807	1	4	2	4	f	f	WorkflowTransition	\N	\N
808	1	4	2	5	f	f	WorkflowTransition	\N	\N
809	2	4	2	4	f	f	WorkflowTransition	\N	\N
810	2	4	2	5	f	f	WorkflowTransition	\N	\N
811	3	4	2	4	f	f	WorkflowTransition	\N	\N
812	3	4	2	5	f	f	WorkflowTransition	\N	\N
813	4	4	2	4	f	f	WorkflowTransition	\N	\N
814	4	4	2	5	f	f	WorkflowTransition	\N	\N
815	5	4	2	4	f	f	WorkflowTransition	\N	\N
816	5	4	2	5	f	f	WorkflowTransition	\N	\N
817	6	4	2	4	f	f	WorkflowTransition	\N	\N
818	6	4	2	5	f	f	WorkflowTransition	\N	\N
819	7	4	2	4	f	f	WorkflowTransition	\N	\N
820	7	4	2	5	f	f	WorkflowTransition	\N	\N
821	8	4	2	4	f	f	WorkflowTransition	\N	\N
822	8	4	2	5	f	f	WorkflowTransition	\N	\N
823	9	4	2	4	f	f	WorkflowTransition	\N	\N
824	9	4	2	5	f	f	WorkflowTransition	\N	\N
825	10	4	2	4	f	f	WorkflowTransition	\N	\N
826	10	4	2	5	f	f	WorkflowTransition	\N	\N
827	11	4	2	4	f	f	WorkflowTransition	\N	\N
828	11	4	2	5	f	f	WorkflowTransition	\N	\N
829	12	4	2	4	f	f	WorkflowTransition	\N	\N
830	12	4	2	5	f	f	WorkflowTransition	\N	\N
831	13	4	2	4	f	f	WorkflowTransition	\N	\N
832	13	4	2	5	f	f	WorkflowTransition	\N	\N
833	1	4	2	4	t	t	WorkflowTransition	\N	\N
834	1	4	2	5	t	t	WorkflowTransition	\N	\N
835	2	4	2	4	t	t	WorkflowTransition	\N	\N
836	2	4	2	5	t	t	WorkflowTransition	\N	\N
837	3	4	2	4	t	t	WorkflowTransition	\N	\N
838	3	4	2	5	t	t	WorkflowTransition	\N	\N
839	4	4	2	4	t	t	WorkflowTransition	\N	\N
840	4	4	2	5	t	t	WorkflowTransition	\N	\N
841	5	4	2	4	t	t	WorkflowTransition	\N	\N
842	5	4	2	5	t	t	WorkflowTransition	\N	\N
843	6	4	2	4	t	t	WorkflowTransition	\N	\N
844	6	4	2	5	t	t	WorkflowTransition	\N	\N
845	7	4	2	4	t	t	WorkflowTransition	\N	\N
846	7	4	2	5	t	t	WorkflowTransition	\N	\N
847	8	4	2	4	t	t	WorkflowTransition	\N	\N
848	8	4	2	5	t	t	WorkflowTransition	\N	\N
849	9	4	2	4	t	t	WorkflowTransition	\N	\N
850	9	4	2	5	t	t	WorkflowTransition	\N	\N
851	10	4	2	4	t	t	WorkflowTransition	\N	\N
852	10	4	2	5	t	t	WorkflowTransition	\N	\N
853	11	4	2	4	t	t	WorkflowTransition	\N	\N
854	11	4	2	5	t	t	WorkflowTransition	\N	\N
855	12	4	2	4	t	t	WorkflowTransition	\N	\N
856	12	4	2	5	t	t	WorkflowTransition	\N	\N
857	13	4	2	4	t	t	WorkflowTransition	\N	\N
858	13	4	2	5	t	t	WorkflowTransition	\N	\N
859	1	4	3	4	f	f	WorkflowTransition	\N	\N
860	1	4	3	5	f	f	WorkflowTransition	\N	\N
861	2	4	3	4	f	f	WorkflowTransition	\N	\N
862	2	4	3	5	f	f	WorkflowTransition	\N	\N
863	3	4	3	4	f	f	WorkflowTransition	\N	\N
864	3	4	3	5	f	f	WorkflowTransition	\N	\N
865	4	4	3	4	f	f	WorkflowTransition	\N	\N
866	4	4	3	5	f	f	WorkflowTransition	\N	\N
867	5	4	3	4	f	f	WorkflowTransition	\N	\N
868	5	4	3	5	f	f	WorkflowTransition	\N	\N
869	6	4	3	4	f	f	WorkflowTransition	\N	\N
870	6	4	3	5	f	f	WorkflowTransition	\N	\N
871	7	4	3	4	f	f	WorkflowTransition	\N	\N
872	7	4	3	5	f	f	WorkflowTransition	\N	\N
873	8	4	3	4	f	f	WorkflowTransition	\N	\N
874	8	4	3	5	f	f	WorkflowTransition	\N	\N
875	9	4	3	4	f	f	WorkflowTransition	\N	\N
876	9	4	3	5	f	f	WorkflowTransition	\N	\N
877	10	4	3	4	f	f	WorkflowTransition	\N	\N
878	10	4	3	5	f	f	WorkflowTransition	\N	\N
879	11	4	3	4	f	f	WorkflowTransition	\N	\N
880	11	4	3	5	f	f	WorkflowTransition	\N	\N
881	12	4	3	4	f	f	WorkflowTransition	\N	\N
882	12	4	3	5	f	f	WorkflowTransition	\N	\N
883	13	4	3	4	f	f	WorkflowTransition	\N	\N
884	13	4	3	5	f	f	WorkflowTransition	\N	\N
885	1	4	3	4	t	t	WorkflowTransition	\N	\N
886	1	4	3	5	t	t	WorkflowTransition	\N	\N
887	2	4	3	4	t	t	WorkflowTransition	\N	\N
888	2	4	3	5	t	t	WorkflowTransition	\N	\N
889	3	4	3	4	t	t	WorkflowTransition	\N	\N
890	3	4	3	5	t	t	WorkflowTransition	\N	\N
891	4	4	3	4	t	t	WorkflowTransition	\N	\N
892	4	4	3	5	t	t	WorkflowTransition	\N	\N
893	5	4	3	4	t	t	WorkflowTransition	\N	\N
894	5	4	3	5	t	t	WorkflowTransition	\N	\N
895	6	4	3	4	t	t	WorkflowTransition	\N	\N
896	6	4	3	5	t	t	WorkflowTransition	\N	\N
897	7	4	3	4	t	t	WorkflowTransition	\N	\N
898	7	4	3	5	t	t	WorkflowTransition	\N	\N
899	8	4	3	4	t	t	WorkflowTransition	\N	\N
900	8	4	3	5	t	t	WorkflowTransition	\N	\N
901	9	4	3	4	t	t	WorkflowTransition	\N	\N
902	9	4	3	5	t	t	WorkflowTransition	\N	\N
903	10	4	3	4	t	t	WorkflowTransition	\N	\N
904	10	4	3	5	t	t	WorkflowTransition	\N	\N
905	11	4	3	4	t	t	WorkflowTransition	\N	\N
906	11	4	3	5	t	t	WorkflowTransition	\N	\N
907	12	4	3	4	t	t	WorkflowTransition	\N	\N
908	12	4	3	5	t	t	WorkflowTransition	\N	\N
909	13	4	3	4	t	t	WorkflowTransition	\N	\N
910	13	4	3	5	t	t	WorkflowTransition	\N	\N
911	1	4	5	4	f	f	WorkflowTransition	\N	\N
912	1	4	5	5	f	f	WorkflowTransition	\N	\N
913	2	4	5	4	f	f	WorkflowTransition	\N	\N
914	2	4	5	5	f	f	WorkflowTransition	\N	\N
915	3	4	5	4	f	f	WorkflowTransition	\N	\N
916	3	4	5	5	f	f	WorkflowTransition	\N	\N
917	4	4	5	4	f	f	WorkflowTransition	\N	\N
918	4	4	5	5	f	f	WorkflowTransition	\N	\N
919	5	4	5	4	f	f	WorkflowTransition	\N	\N
920	5	4	5	5	f	f	WorkflowTransition	\N	\N
921	6	4	5	4	f	f	WorkflowTransition	\N	\N
922	6	4	5	5	f	f	WorkflowTransition	\N	\N
923	7	4	5	4	f	f	WorkflowTransition	\N	\N
924	7	4	5	5	f	f	WorkflowTransition	\N	\N
925	8	4	5	4	f	f	WorkflowTransition	\N	\N
926	8	4	5	5	f	f	WorkflowTransition	\N	\N
927	9	4	5	4	f	f	WorkflowTransition	\N	\N
928	9	4	5	5	f	f	WorkflowTransition	\N	\N
929	10	4	5	4	f	f	WorkflowTransition	\N	\N
930	10	4	5	5	f	f	WorkflowTransition	\N	\N
931	11	4	5	4	f	f	WorkflowTransition	\N	\N
932	11	4	5	5	f	f	WorkflowTransition	\N	\N
933	12	4	5	4	f	f	WorkflowTransition	\N	\N
934	12	4	5	5	f	f	WorkflowTransition	\N	\N
935	13	4	5	4	f	f	WorkflowTransition	\N	\N
936	13	4	5	5	f	f	WorkflowTransition	\N	\N
937	1	4	5	4	t	t	WorkflowTransition	\N	\N
938	1	4	5	5	t	t	WorkflowTransition	\N	\N
939	2	4	5	4	t	t	WorkflowTransition	\N	\N
940	2	4	5	5	t	t	WorkflowTransition	\N	\N
941	3	4	5	4	t	t	WorkflowTransition	\N	\N
942	3	4	5	5	t	t	WorkflowTransition	\N	\N
943	4	4	5	4	t	t	WorkflowTransition	\N	\N
944	4	4	5	5	t	t	WorkflowTransition	\N	\N
945	5	4	5	4	t	t	WorkflowTransition	\N	\N
946	5	4	5	5	t	t	WorkflowTransition	\N	\N
947	6	4	5	4	t	t	WorkflowTransition	\N	\N
948	6	4	5	5	t	t	WorkflowTransition	\N	\N
949	7	4	5	4	t	t	WorkflowTransition	\N	\N
950	7	4	5	5	t	t	WorkflowTransition	\N	\N
951	8	4	5	4	t	t	WorkflowTransition	\N	\N
952	8	4	5	5	t	t	WorkflowTransition	\N	\N
953	9	4	5	4	t	t	WorkflowTransition	\N	\N
954	9	4	5	5	t	t	WorkflowTransition	\N	\N
955	10	4	5	4	t	t	WorkflowTransition	\N	\N
956	10	4	5	5	t	t	WorkflowTransition	\N	\N
957	11	4	5	4	t	t	WorkflowTransition	\N	\N
958	11	4	5	5	t	t	WorkflowTransition	\N	\N
959	12	4	5	4	t	t	WorkflowTransition	\N	\N
960	12	4	5	5	t	t	WorkflowTransition	\N	\N
961	13	4	5	4	t	t	WorkflowTransition	\N	\N
962	13	4	5	5	t	t	WorkflowTransition	\N	\N
963	1	5	1	4	f	f	WorkflowTransition	\N	\N
964	1	5	1	5	f	f	WorkflowTransition	\N	\N
965	2	5	1	4	f	f	WorkflowTransition	\N	\N
966	2	5	1	5	f	f	WorkflowTransition	\N	\N
967	3	5	1	4	f	f	WorkflowTransition	\N	\N
968	3	5	1	5	f	f	WorkflowTransition	\N	\N
969	4	5	1	4	f	f	WorkflowTransition	\N	\N
970	4	5	1	5	f	f	WorkflowTransition	\N	\N
971	5	5	1	4	f	f	WorkflowTransition	\N	\N
972	5	5	1	5	f	f	WorkflowTransition	\N	\N
973	6	5	1	4	f	f	WorkflowTransition	\N	\N
974	6	5	1	5	f	f	WorkflowTransition	\N	\N
975	7	5	1	4	f	f	WorkflowTransition	\N	\N
976	7	5	1	5	f	f	WorkflowTransition	\N	\N
977	8	5	1	4	f	f	WorkflowTransition	\N	\N
978	8	5	1	5	f	f	WorkflowTransition	\N	\N
979	9	5	1	4	f	f	WorkflowTransition	\N	\N
980	9	5	1	5	f	f	WorkflowTransition	\N	\N
981	10	5	1	4	f	f	WorkflowTransition	\N	\N
982	10	5	1	5	f	f	WorkflowTransition	\N	\N
983	11	5	1	4	f	f	WorkflowTransition	\N	\N
984	11	5	1	5	f	f	WorkflowTransition	\N	\N
985	12	5	1	4	f	f	WorkflowTransition	\N	\N
986	12	5	1	5	f	f	WorkflowTransition	\N	\N
987	13	5	1	4	f	f	WorkflowTransition	\N	\N
988	13	5	1	5	f	f	WorkflowTransition	\N	\N
989	1	5	1	4	t	t	WorkflowTransition	\N	\N
990	1	5	1	5	t	t	WorkflowTransition	\N	\N
991	2	5	1	4	t	t	WorkflowTransition	\N	\N
992	2	5	1	5	t	t	WorkflowTransition	\N	\N
993	3	5	1	4	t	t	WorkflowTransition	\N	\N
994	3	5	1	5	t	t	WorkflowTransition	\N	\N
995	4	5	1	4	t	t	WorkflowTransition	\N	\N
996	4	5	1	5	t	t	WorkflowTransition	\N	\N
997	5	5	1	4	t	t	WorkflowTransition	\N	\N
998	5	5	1	5	t	t	WorkflowTransition	\N	\N
999	6	5	1	4	t	t	WorkflowTransition	\N	\N
1000	6	5	1	5	t	t	WorkflowTransition	\N	\N
1001	7	5	1	4	t	t	WorkflowTransition	\N	\N
1002	7	5	1	5	t	t	WorkflowTransition	\N	\N
1003	8	5	1	4	t	t	WorkflowTransition	\N	\N
1004	8	5	1	5	t	t	WorkflowTransition	\N	\N
1005	9	5	1	4	t	t	WorkflowTransition	\N	\N
1006	9	5	1	5	t	t	WorkflowTransition	\N	\N
1007	10	5	1	4	t	t	WorkflowTransition	\N	\N
1008	10	5	1	5	t	t	WorkflowTransition	\N	\N
1009	11	5	1	4	t	t	WorkflowTransition	\N	\N
1010	11	5	1	5	t	t	WorkflowTransition	\N	\N
1011	12	5	1	4	t	t	WorkflowTransition	\N	\N
1012	12	5	1	5	t	t	WorkflowTransition	\N	\N
1013	13	5	1	4	t	t	WorkflowTransition	\N	\N
1014	13	5	1	5	t	t	WorkflowTransition	\N	\N
1015	1	5	2	4	f	f	WorkflowTransition	\N	\N
1016	1	5	2	5	f	f	WorkflowTransition	\N	\N
1017	2	5	2	4	f	f	WorkflowTransition	\N	\N
1018	2	5	2	5	f	f	WorkflowTransition	\N	\N
1019	3	5	2	4	f	f	WorkflowTransition	\N	\N
1020	3	5	2	5	f	f	WorkflowTransition	\N	\N
1021	4	5	2	4	f	f	WorkflowTransition	\N	\N
1022	4	5	2	5	f	f	WorkflowTransition	\N	\N
1023	5	5	2	4	f	f	WorkflowTransition	\N	\N
1024	5	5	2	5	f	f	WorkflowTransition	\N	\N
1025	6	5	2	4	f	f	WorkflowTransition	\N	\N
1026	6	5	2	5	f	f	WorkflowTransition	\N	\N
1027	7	5	2	4	f	f	WorkflowTransition	\N	\N
1028	7	5	2	5	f	f	WorkflowTransition	\N	\N
1029	8	5	2	4	f	f	WorkflowTransition	\N	\N
1030	8	5	2	5	f	f	WorkflowTransition	\N	\N
1031	9	5	2	4	f	f	WorkflowTransition	\N	\N
1032	9	5	2	5	f	f	WorkflowTransition	\N	\N
1033	10	5	2	4	f	f	WorkflowTransition	\N	\N
1034	10	5	2	5	f	f	WorkflowTransition	\N	\N
1035	11	5	2	4	f	f	WorkflowTransition	\N	\N
1036	11	5	2	5	f	f	WorkflowTransition	\N	\N
1037	12	5	2	4	f	f	WorkflowTransition	\N	\N
1038	12	5	2	5	f	f	WorkflowTransition	\N	\N
1039	13	5	2	4	f	f	WorkflowTransition	\N	\N
1040	13	5	2	5	f	f	WorkflowTransition	\N	\N
1041	1	5	2	4	t	t	WorkflowTransition	\N	\N
1042	1	5	2	5	t	t	WorkflowTransition	\N	\N
1043	2	5	2	4	t	t	WorkflowTransition	\N	\N
1044	2	5	2	5	t	t	WorkflowTransition	\N	\N
1045	3	5	2	4	t	t	WorkflowTransition	\N	\N
1046	3	5	2	5	t	t	WorkflowTransition	\N	\N
1047	4	5	2	4	t	t	WorkflowTransition	\N	\N
1048	4	5	2	5	t	t	WorkflowTransition	\N	\N
1049	5	5	2	4	t	t	WorkflowTransition	\N	\N
1050	5	5	2	5	t	t	WorkflowTransition	\N	\N
1051	6	5	2	4	t	t	WorkflowTransition	\N	\N
1052	6	5	2	5	t	t	WorkflowTransition	\N	\N
1053	7	5	2	4	t	t	WorkflowTransition	\N	\N
1054	7	5	2	5	t	t	WorkflowTransition	\N	\N
1055	8	5	2	4	t	t	WorkflowTransition	\N	\N
1056	8	5	2	5	t	t	WorkflowTransition	\N	\N
1057	9	5	2	4	t	t	WorkflowTransition	\N	\N
1058	9	5	2	5	t	t	WorkflowTransition	\N	\N
1059	10	5	2	4	t	t	WorkflowTransition	\N	\N
1060	10	5	2	5	t	t	WorkflowTransition	\N	\N
1061	11	5	2	4	t	t	WorkflowTransition	\N	\N
1062	11	5	2	5	t	t	WorkflowTransition	\N	\N
1063	12	5	2	4	t	t	WorkflowTransition	\N	\N
1064	12	5	2	5	t	t	WorkflowTransition	\N	\N
1065	13	5	2	4	t	t	WorkflowTransition	\N	\N
1066	13	5	2	5	t	t	WorkflowTransition	\N	\N
1067	1	5	3	4	f	f	WorkflowTransition	\N	\N
1068	1	5	3	5	f	f	WorkflowTransition	\N	\N
1069	2	5	3	4	f	f	WorkflowTransition	\N	\N
1070	2	5	3	5	f	f	WorkflowTransition	\N	\N
1071	3	5	3	4	f	f	WorkflowTransition	\N	\N
1072	3	5	3	5	f	f	WorkflowTransition	\N	\N
1073	4	5	3	4	f	f	WorkflowTransition	\N	\N
1074	4	5	3	5	f	f	WorkflowTransition	\N	\N
1075	5	5	3	4	f	f	WorkflowTransition	\N	\N
1076	5	5	3	5	f	f	WorkflowTransition	\N	\N
1077	6	5	3	4	f	f	WorkflowTransition	\N	\N
1078	6	5	3	5	f	f	WorkflowTransition	\N	\N
1079	7	5	3	4	f	f	WorkflowTransition	\N	\N
1080	7	5	3	5	f	f	WorkflowTransition	\N	\N
1081	8	5	3	4	f	f	WorkflowTransition	\N	\N
1082	8	5	3	5	f	f	WorkflowTransition	\N	\N
1083	9	5	3	4	f	f	WorkflowTransition	\N	\N
1084	9	5	3	5	f	f	WorkflowTransition	\N	\N
1085	10	5	3	4	f	f	WorkflowTransition	\N	\N
1086	10	5	3	5	f	f	WorkflowTransition	\N	\N
1087	11	5	3	4	f	f	WorkflowTransition	\N	\N
1088	11	5	3	5	f	f	WorkflowTransition	\N	\N
1089	12	5	3	4	f	f	WorkflowTransition	\N	\N
1090	12	5	3	5	f	f	WorkflowTransition	\N	\N
1091	13	5	3	4	f	f	WorkflowTransition	\N	\N
1092	13	5	3	5	f	f	WorkflowTransition	\N	\N
1093	1	5	3	4	t	t	WorkflowTransition	\N	\N
1094	1	5	3	5	t	t	WorkflowTransition	\N	\N
1095	2	5	3	4	t	t	WorkflowTransition	\N	\N
1096	2	5	3	5	t	t	WorkflowTransition	\N	\N
1097	3	5	3	4	t	t	WorkflowTransition	\N	\N
1098	3	5	3	5	t	t	WorkflowTransition	\N	\N
1099	4	5	3	4	t	t	WorkflowTransition	\N	\N
1100	4	5	3	5	t	t	WorkflowTransition	\N	\N
1101	5	5	3	4	t	t	WorkflowTransition	\N	\N
1102	5	5	3	5	t	t	WorkflowTransition	\N	\N
1103	6	5	3	4	t	t	WorkflowTransition	\N	\N
1104	6	5	3	5	t	t	WorkflowTransition	\N	\N
1105	7	5	3	4	t	t	WorkflowTransition	\N	\N
1106	7	5	3	5	t	t	WorkflowTransition	\N	\N
1107	8	5	3	4	t	t	WorkflowTransition	\N	\N
1108	8	5	3	5	t	t	WorkflowTransition	\N	\N
1109	9	5	3	4	t	t	WorkflowTransition	\N	\N
1110	9	5	3	5	t	t	WorkflowTransition	\N	\N
1111	10	5	3	4	t	t	WorkflowTransition	\N	\N
1112	10	5	3	5	t	t	WorkflowTransition	\N	\N
1113	11	5	3	4	t	t	WorkflowTransition	\N	\N
1114	11	5	3	5	t	t	WorkflowTransition	\N	\N
1115	12	5	3	4	t	t	WorkflowTransition	\N	\N
1116	12	5	3	5	t	t	WorkflowTransition	\N	\N
1117	13	5	3	4	t	t	WorkflowTransition	\N	\N
1118	13	5	3	5	t	t	WorkflowTransition	\N	\N
1119	1	5	4	4	f	f	WorkflowTransition	\N	\N
1120	1	5	4	5	f	f	WorkflowTransition	\N	\N
1121	2	5	4	4	f	f	WorkflowTransition	\N	\N
1122	2	5	4	5	f	f	WorkflowTransition	\N	\N
1123	3	5	4	4	f	f	WorkflowTransition	\N	\N
1124	3	5	4	5	f	f	WorkflowTransition	\N	\N
1125	4	5	4	4	f	f	WorkflowTransition	\N	\N
1126	4	5	4	5	f	f	WorkflowTransition	\N	\N
1127	5	5	4	4	f	f	WorkflowTransition	\N	\N
1128	5	5	4	5	f	f	WorkflowTransition	\N	\N
1129	6	5	4	4	f	f	WorkflowTransition	\N	\N
1130	6	5	4	5	f	f	WorkflowTransition	\N	\N
1131	7	5	4	4	f	f	WorkflowTransition	\N	\N
1132	7	5	4	5	f	f	WorkflowTransition	\N	\N
1133	8	5	4	4	f	f	WorkflowTransition	\N	\N
1134	8	5	4	5	f	f	WorkflowTransition	\N	\N
1135	9	5	4	4	f	f	WorkflowTransition	\N	\N
1136	9	5	4	5	f	f	WorkflowTransition	\N	\N
1137	10	5	4	4	f	f	WorkflowTransition	\N	\N
1138	10	5	4	5	f	f	WorkflowTransition	\N	\N
1139	11	5	4	4	f	f	WorkflowTransition	\N	\N
1140	11	5	4	5	f	f	WorkflowTransition	\N	\N
1141	12	5	4	4	f	f	WorkflowTransition	\N	\N
1142	12	5	4	5	f	f	WorkflowTransition	\N	\N
1143	13	5	4	4	f	f	WorkflowTransition	\N	\N
1144	13	5	4	5	f	f	WorkflowTransition	\N	\N
1145	1	5	4	4	t	t	WorkflowTransition	\N	\N
1146	1	5	4	5	t	t	WorkflowTransition	\N	\N
1147	2	5	4	4	t	t	WorkflowTransition	\N	\N
1148	2	5	4	5	t	t	WorkflowTransition	\N	\N
1149	3	5	4	4	t	t	WorkflowTransition	\N	\N
1150	3	5	4	5	t	t	WorkflowTransition	\N	\N
1151	4	5	4	4	t	t	WorkflowTransition	\N	\N
1152	4	5	4	5	t	t	WorkflowTransition	\N	\N
1153	5	5	4	4	t	t	WorkflowTransition	\N	\N
1154	5	5	4	5	t	t	WorkflowTransition	\N	\N
1155	6	5	4	4	t	t	WorkflowTransition	\N	\N
1156	6	5	4	5	t	t	WorkflowTransition	\N	\N
1157	7	5	4	4	t	t	WorkflowTransition	\N	\N
1158	7	5	4	5	t	t	WorkflowTransition	\N	\N
1159	8	5	4	4	t	t	WorkflowTransition	\N	\N
1160	8	5	4	5	t	t	WorkflowTransition	\N	\N
1161	9	5	4	4	t	t	WorkflowTransition	\N	\N
1162	9	5	4	5	t	t	WorkflowTransition	\N	\N
1163	10	5	4	4	t	t	WorkflowTransition	\N	\N
1164	10	5	4	5	t	t	WorkflowTransition	\N	\N
1165	11	5	4	4	t	t	WorkflowTransition	\N	\N
1166	11	5	4	5	t	t	WorkflowTransition	\N	\N
1167	12	5	4	4	t	t	WorkflowTransition	\N	\N
1168	12	5	4	5	t	t	WorkflowTransition	\N	\N
1169	13	5	4	4	t	t	WorkflowTransition	\N	\N
1170	13	5	4	5	t	t	WorkflowTransition	\N	\N
\.


--
-- Name: attachments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.attachments_id_seq', 1, false);


--
-- Name: auth_sources_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auth_sources_id_seq', 1, false);


--
-- Name: boards_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.boards_id_seq', 1, false);


--
-- Name: changes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.changes_id_seq', 1, false);


--
-- Name: changesets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.changesets_id_seq', 1, false);


--
-- Name: comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.comments_id_seq', 1, false);


--
-- Name: custom_field_enumerations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.custom_field_enumerations_id_seq', 6, true);


--
-- Name: custom_fields_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.custom_fields_id_seq', 5, true);


--
-- Name: custom_values_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.custom_values_id_seq', 162, true);


--
-- Name: documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.documents_id_seq', 1, false);


--
-- Name: email_addresses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.email_addresses_id_seq', 6, true);


--
-- Name: enabled_modules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.enabled_modules_id_seq', 30, true);


--
-- Name: enumerations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.enumerations_id_seq', 4, true);


--
-- Name: import_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.import_items_id_seq', 1, false);


--
-- Name: imports_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.imports_id_seq', 1, false);


--
-- Name: issue_categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.issue_categories_id_seq', 1, false);


--
-- Name: issue_relations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.issue_relations_id_seq', 1, false);


--
-- Name: issue_statuses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.issue_statuses_id_seq', 5, true);


--
-- Name: issues_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.issues_id_seq', 54, true);


--
-- Name: journal_details_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.journal_details_id_seq', 304, true);


--
-- Name: journals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.journals_id_seq', 244, true);


--
-- Name: member_roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.member_roles_id_seq', 21, true);


--
-- Name: members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.members_id_seq', 13, true);


--
-- Name: messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.messages_id_seq', 1, false);


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.news_id_seq', 1, false);


--
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projects_id_seq', 3, true);


--
-- Name: queries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.queries_id_seq', 1, false);


--
-- Name: repositories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.repositories_id_seq', 1, false);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_id_seq', 11, true);


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.settings_id_seq', 4, true);


--
-- Name: time_entries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.time_entries_id_seq', 30, true);


--
-- Name: tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tokens_id_seq', 25, true);


--
-- Name: trackers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.trackers_id_seq', 13, true);


--
-- Name: user_preferences_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_preferences_id_seq', 6, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 9, true);


--
-- Name: versions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.versions_id_seq', 5, true);


--
-- Name: watchers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.watchers_id_seq', 54, true);


--
-- Name: wiki_content_versions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.wiki_content_versions_id_seq', 1, false);


--
-- Name: wiki_contents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.wiki_contents_id_seq', 1, false);


--
-- Name: wiki_pages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.wiki_pages_id_seq', 1, false);


--
-- Name: wiki_redirects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.wiki_redirects_id_seq', 1, false);


--
-- Name: wikis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.wikis_id_seq', 3, true);


--
-- Name: workflows_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workflows_id_seq', 1170, true);


--
-- Name: ar_internal_metadata ar_internal_metadata_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ar_internal_metadata
    ADD CONSTRAINT ar_internal_metadata_pkey PRIMARY KEY (key);


--
-- Name: attachments attachments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attachments
    ADD CONSTRAINT attachments_pkey PRIMARY KEY (id);


--
-- Name: auth_sources auth_sources_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_sources
    ADD CONSTRAINT auth_sources_pkey PRIMARY KEY (id);


--
-- Name: boards boards_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boards
    ADD CONSTRAINT boards_pkey PRIMARY KEY (id);


--
-- Name: changes changes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.changes
    ADD CONSTRAINT changes_pkey PRIMARY KEY (id);


--
-- Name: changesets changesets_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.changesets
    ADD CONSTRAINT changesets_pkey PRIMARY KEY (id);


--
-- Name: comments comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);


--
-- Name: custom_field_enumerations custom_field_enumerations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.custom_field_enumerations
    ADD CONSTRAINT custom_field_enumerations_pkey PRIMARY KEY (id);


--
-- Name: custom_fields custom_fields_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.custom_fields
    ADD CONSTRAINT custom_fields_pkey PRIMARY KEY (id);


--
-- Name: custom_values custom_values_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.custom_values
    ADD CONSTRAINT custom_values_pkey PRIMARY KEY (id);


--
-- Name: documents documents_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documents
    ADD CONSTRAINT documents_pkey PRIMARY KEY (id);


--
-- Name: email_addresses email_addresses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.email_addresses
    ADD CONSTRAINT email_addresses_pkey PRIMARY KEY (id);


--
-- Name: enabled_modules enabled_modules_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enabled_modules
    ADD CONSTRAINT enabled_modules_pkey PRIMARY KEY (id);


--
-- Name: enumerations enumerations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enumerations
    ADD CONSTRAINT enumerations_pkey PRIMARY KEY (id);


--
-- Name: import_items import_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.import_items
    ADD CONSTRAINT import_items_pkey PRIMARY KEY (id);


--
-- Name: imports imports_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.imports
    ADD CONSTRAINT imports_pkey PRIMARY KEY (id);


--
-- Name: issue_categories issue_categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issue_categories
    ADD CONSTRAINT issue_categories_pkey PRIMARY KEY (id);


--
-- Name: issue_relations issue_relations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issue_relations
    ADD CONSTRAINT issue_relations_pkey PRIMARY KEY (id);


--
-- Name: issue_statuses issue_statuses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issue_statuses
    ADD CONSTRAINT issue_statuses_pkey PRIMARY KEY (id);


--
-- Name: issues issues_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.issues
    ADD CONSTRAINT issues_pkey PRIMARY KEY (id);


--
-- Name: journal_details journal_details_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.journal_details
    ADD CONSTRAINT journal_details_pkey PRIMARY KEY (id);


--
-- Name: journals journals_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.journals
    ADD CONSTRAINT journals_pkey PRIMARY KEY (id);


--
-- Name: member_roles member_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_roles
    ADD CONSTRAINT member_roles_pkey PRIMARY KEY (id);


--
-- Name: members members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members
    ADD CONSTRAINT members_pkey PRIMARY KEY (id);


--
-- Name: messages messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (id);


--
-- Name: news news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: projects projects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- Name: queries queries_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.queries
    ADD CONSTRAINT queries_pkey PRIMARY KEY (id);


--
-- Name: repositories repositories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.repositories
    ADD CONSTRAINT repositories_pkey PRIMARY KEY (id);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: schema_migrations schema_migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.schema_migrations
    ADD CONSTRAINT schema_migrations_pkey PRIMARY KEY (version);


--
-- Name: settings settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings
    ADD CONSTRAINT settings_pkey PRIMARY KEY (id);


--
-- Name: time_entries time_entries_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_entries
    ADD CONSTRAINT time_entries_pkey PRIMARY KEY (id);


--
-- Name: tokens tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tokens
    ADD CONSTRAINT tokens_pkey PRIMARY KEY (id);


--
-- Name: trackers trackers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trackers
    ADD CONSTRAINT trackers_pkey PRIMARY KEY (id);


--
-- Name: user_preferences user_preferences_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_preferences
    ADD CONSTRAINT user_preferences_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: versions versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.versions
    ADD CONSTRAINT versions_pkey PRIMARY KEY (id);


--
-- Name: watchers watchers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.watchers
    ADD CONSTRAINT watchers_pkey PRIMARY KEY (id);


--
-- Name: wiki_content_versions wiki_content_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_content_versions
    ADD CONSTRAINT wiki_content_versions_pkey PRIMARY KEY (id);


--
-- Name: wiki_contents wiki_contents_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_contents
    ADD CONSTRAINT wiki_contents_pkey PRIMARY KEY (id);


--
-- Name: wiki_pages wiki_pages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_pages
    ADD CONSTRAINT wiki_pages_pkey PRIMARY KEY (id);


--
-- Name: wiki_redirects wiki_redirects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wiki_redirects
    ADD CONSTRAINT wiki_redirects_pkey PRIMARY KEY (id);


--
-- Name: wikis wikis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wikis
    ADD CONSTRAINT wikis_pkey PRIMARY KEY (id);


--
-- Name: workflows workflows_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflows
    ADD CONSTRAINT workflows_pkey PRIMARY KEY (id);


--
-- Name: boards_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX boards_project_id ON public.boards USING btree (project_id);


--
-- Name: changeset_parents_changeset_ids; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX changeset_parents_changeset_ids ON public.changeset_parents USING btree (changeset_id);


--
-- Name: changeset_parents_parent_ids; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX changeset_parents_parent_ids ON public.changeset_parents USING btree (parent_id);


--
-- Name: changesets_changeset_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX changesets_changeset_id ON public.changes USING btree (changeset_id);


--
-- Name: changesets_issues_ids; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX changesets_issues_ids ON public.changesets_issues USING btree (changeset_id, issue_id);


--
-- Name: changesets_repos_rev; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX changesets_repos_rev ON public.changesets USING btree (repository_id, revision);


--
-- Name: changesets_repos_scmid; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX changesets_repos_scmid ON public.changesets USING btree (repository_id, scmid);


--
-- Name: custom_fields_roles_ids; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX custom_fields_roles_ids ON public.custom_fields_roles USING btree (custom_field_id, role_id);


--
-- Name: custom_values_customized_custom_field; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX custom_values_customized_custom_field ON public.custom_values USING btree (customized_type, customized_id, custom_field_id);


--
-- Name: documents_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX documents_project_id ON public.documents USING btree (project_id);


--
-- Name: enabled_modules_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX enabled_modules_project_id ON public.enabled_modules USING btree (project_id);


--
-- Name: groups_users_ids; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX groups_users_ids ON public.groups_users USING btree (group_id, user_id);


--
-- Name: index_attachments_on_author_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_attachments_on_author_id ON public.attachments USING btree (author_id);


--
-- Name: index_attachments_on_container_id_and_container_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_attachments_on_container_id_and_container_type ON public.attachments USING btree (container_id, container_type);


--
-- Name: index_attachments_on_created_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_attachments_on_created_on ON public.attachments USING btree (created_on);


--
-- Name: index_attachments_on_disk_filename; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_attachments_on_disk_filename ON public.attachments USING btree (disk_filename);


--
-- Name: index_auth_sources_on_id_and_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_auth_sources_on_id_and_type ON public.auth_sources USING btree (id, type);


--
-- Name: index_boards_on_last_message_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_boards_on_last_message_id ON public.boards USING btree (last_message_id);


--
-- Name: index_changesets_issues_on_issue_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_changesets_issues_on_issue_id ON public.changesets_issues USING btree (issue_id);


--
-- Name: index_changesets_on_committed_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_changesets_on_committed_on ON public.changesets USING btree (committed_on);


--
-- Name: index_changesets_on_repository_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_changesets_on_repository_id ON public.changesets USING btree (repository_id);


--
-- Name: index_changesets_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_changesets_on_user_id ON public.changesets USING btree (user_id);


--
-- Name: index_comments_on_author_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_comments_on_author_id ON public.comments USING btree (author_id);


--
-- Name: index_comments_on_commented_id_and_commented_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_comments_on_commented_id_and_commented_type ON public.comments USING btree (commented_id, commented_type);


--
-- Name: index_custom_fields_on_id_and_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_custom_fields_on_id_and_type ON public.custom_fields USING btree (id, type);


--
-- Name: index_custom_fields_projects_on_custom_field_id_and_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX index_custom_fields_projects_on_custom_field_id_and_project_id ON public.custom_fields_projects USING btree (custom_field_id, project_id);


--
-- Name: index_custom_fields_trackers_on_custom_field_id_and_tracker_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX index_custom_fields_trackers_on_custom_field_id_and_tracker_id ON public.custom_fields_trackers USING btree (custom_field_id, tracker_id);


--
-- Name: index_custom_values_on_custom_field_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_custom_values_on_custom_field_id ON public.custom_values USING btree (custom_field_id);


--
-- Name: index_documents_on_category_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_documents_on_category_id ON public.documents USING btree (category_id);


--
-- Name: index_documents_on_created_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_documents_on_created_on ON public.documents USING btree (created_on);


--
-- Name: index_email_addresses_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_email_addresses_on_user_id ON public.email_addresses USING btree (user_id);


--
-- Name: index_enumerations_on_id_and_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_enumerations_on_id_and_type ON public.enumerations USING btree (id, type);


--
-- Name: index_enumerations_on_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_enumerations_on_project_id ON public.enumerations USING btree (project_id);


--
-- Name: index_import_items_on_import_id_and_unique_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_import_items_on_import_id_and_unique_id ON public.import_items USING btree (import_id, unique_id);


--
-- Name: index_issue_categories_on_assigned_to_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issue_categories_on_assigned_to_id ON public.issue_categories USING btree (assigned_to_id);


--
-- Name: index_issue_relations_on_issue_from_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issue_relations_on_issue_from_id ON public.issue_relations USING btree (issue_from_id);


--
-- Name: index_issue_relations_on_issue_from_id_and_issue_to_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX index_issue_relations_on_issue_from_id_and_issue_to_id ON public.issue_relations USING btree (issue_from_id, issue_to_id);


--
-- Name: index_issue_relations_on_issue_to_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issue_relations_on_issue_to_id ON public.issue_relations USING btree (issue_to_id);


--
-- Name: index_issue_statuses_on_is_closed; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issue_statuses_on_is_closed ON public.issue_statuses USING btree (is_closed);


--
-- Name: index_issue_statuses_on_position; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issue_statuses_on_position ON public.issue_statuses USING btree ("position");


--
-- Name: index_issues_on_assigned_to_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_assigned_to_id ON public.issues USING btree (assigned_to_id);


--
-- Name: index_issues_on_author_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_author_id ON public.issues USING btree (author_id);


--
-- Name: index_issues_on_category_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_category_id ON public.issues USING btree (category_id);


--
-- Name: index_issues_on_created_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_created_on ON public.issues USING btree (created_on);


--
-- Name: index_issues_on_fixed_version_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_fixed_version_id ON public.issues USING btree (fixed_version_id);


--
-- Name: index_issues_on_parent_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_parent_id ON public.issues USING btree (parent_id);


--
-- Name: index_issues_on_priority_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_priority_id ON public.issues USING btree (priority_id);


--
-- Name: index_issues_on_root_id_and_lft_and_rgt; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_root_id_and_lft_and_rgt ON public.issues USING btree (root_id, lft, rgt);


--
-- Name: index_issues_on_status_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_status_id ON public.issues USING btree (status_id);


--
-- Name: index_issues_on_tracker_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_issues_on_tracker_id ON public.issues USING btree (tracker_id);


--
-- Name: index_journals_on_created_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_journals_on_created_on ON public.journals USING btree (created_on);


--
-- Name: index_journals_on_journalized_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_journals_on_journalized_id ON public.journals USING btree (journalized_id);


--
-- Name: index_journals_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_journals_on_user_id ON public.journals USING btree (user_id);


--
-- Name: index_member_roles_on_inherited_from; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_member_roles_on_inherited_from ON public.member_roles USING btree (inherited_from);


--
-- Name: index_member_roles_on_member_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_member_roles_on_member_id ON public.member_roles USING btree (member_id);


--
-- Name: index_member_roles_on_role_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_member_roles_on_role_id ON public.member_roles USING btree (role_id);


--
-- Name: index_members_on_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_members_on_project_id ON public.members USING btree (project_id);


--
-- Name: index_members_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_members_on_user_id ON public.members USING btree (user_id);


--
-- Name: index_members_on_user_id_and_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX index_members_on_user_id_and_project_id ON public.members USING btree (user_id, project_id);


--
-- Name: index_messages_on_author_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_messages_on_author_id ON public.messages USING btree (author_id);


--
-- Name: index_messages_on_created_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_messages_on_created_on ON public.messages USING btree (created_on);


--
-- Name: index_messages_on_last_reply_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_messages_on_last_reply_id ON public.messages USING btree (last_reply_id);


--
-- Name: index_news_on_author_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_news_on_author_id ON public.news USING btree (author_id);


--
-- Name: index_news_on_created_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_news_on_created_on ON public.news USING btree (created_on);


--
-- Name: index_projects_on_lft; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_projects_on_lft ON public.projects USING btree (lft);


--
-- Name: index_projects_on_rgt; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_projects_on_rgt ON public.projects USING btree (rgt);


--
-- Name: index_queries_on_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_queries_on_project_id ON public.queries USING btree (project_id);


--
-- Name: index_queries_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_queries_on_user_id ON public.queries USING btree (user_id);


--
-- Name: index_repositories_on_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_repositories_on_project_id ON public.repositories USING btree (project_id);


--
-- Name: index_roles_managed_roles_on_role_id_and_managed_role_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX index_roles_managed_roles_on_role_id_and_managed_role_id ON public.roles_managed_roles USING btree (role_id, managed_role_id);


--
-- Name: index_settings_on_name; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_settings_on_name ON public.settings USING btree (name);


--
-- Name: index_time_entries_on_activity_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_time_entries_on_activity_id ON public.time_entries USING btree (activity_id);


--
-- Name: index_time_entries_on_created_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_time_entries_on_created_on ON public.time_entries USING btree (created_on);


--
-- Name: index_time_entries_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_time_entries_on_user_id ON public.time_entries USING btree (user_id);


--
-- Name: index_tokens_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_tokens_on_user_id ON public.tokens USING btree (user_id);


--
-- Name: index_user_preferences_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_user_preferences_on_user_id ON public.user_preferences USING btree (user_id);


--
-- Name: index_users_on_auth_source_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_users_on_auth_source_id ON public.users USING btree (auth_source_id);


--
-- Name: index_users_on_id_and_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_users_on_id_and_type ON public.users USING btree (id, type);


--
-- Name: index_users_on_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_users_on_type ON public.users USING btree (type);


--
-- Name: index_versions_on_sharing; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_versions_on_sharing ON public.versions USING btree (sharing);


--
-- Name: index_watchers_on_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_watchers_on_user_id ON public.watchers USING btree (user_id);


--
-- Name: index_watchers_on_watchable_id_and_watchable_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_watchers_on_watchable_id_and_watchable_type ON public.watchers USING btree (watchable_id, watchable_type);


--
-- Name: index_wiki_content_versions_on_updated_on; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_wiki_content_versions_on_updated_on ON public.wiki_content_versions USING btree (updated_on);


--
-- Name: index_wiki_contents_on_author_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_wiki_contents_on_author_id ON public.wiki_contents USING btree (author_id);


--
-- Name: index_wiki_pages_on_parent_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_wiki_pages_on_parent_id ON public.wiki_pages USING btree (parent_id);


--
-- Name: index_wiki_pages_on_wiki_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_wiki_pages_on_wiki_id ON public.wiki_pages USING btree (wiki_id);


--
-- Name: index_wiki_redirects_on_wiki_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_wiki_redirects_on_wiki_id ON public.wiki_redirects USING btree (wiki_id);


--
-- Name: index_workflows_on_new_status_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_workflows_on_new_status_id ON public.workflows USING btree (new_status_id);


--
-- Name: index_workflows_on_old_status_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_workflows_on_old_status_id ON public.workflows USING btree (old_status_id);


--
-- Name: index_workflows_on_role_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_workflows_on_role_id ON public.workflows USING btree (role_id);


--
-- Name: index_workflows_on_tracker_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_workflows_on_tracker_id ON public.workflows USING btree (tracker_id);


--
-- Name: issue_categories_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX issue_categories_project_id ON public.issue_categories USING btree (project_id);


--
-- Name: issues_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX issues_project_id ON public.issues USING btree (project_id);


--
-- Name: journal_details_journal_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX journal_details_journal_id ON public.journal_details USING btree (journal_id);


--
-- Name: journals_journalized_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX journals_journalized_id ON public.journals USING btree (journalized_id, journalized_type);


--
-- Name: messages_board_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX messages_board_id ON public.messages USING btree (board_id);


--
-- Name: messages_parent_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX messages_parent_id ON public.messages USING btree (parent_id);


--
-- Name: news_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX news_project_id ON public.news USING btree (project_id);


--
-- Name: projects_trackers_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX projects_trackers_project_id ON public.projects_trackers USING btree (project_id);


--
-- Name: projects_trackers_unique; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX projects_trackers_unique ON public.projects_trackers USING btree (project_id, tracker_id);


--
-- Name: queries_roles_ids; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX queries_roles_ids ON public.queries_roles USING btree (query_id, role_id);


--
-- Name: time_entries_issue_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX time_entries_issue_id ON public.time_entries USING btree (issue_id);


--
-- Name: time_entries_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX time_entries_project_id ON public.time_entries USING btree (project_id);


--
-- Name: tokens_value; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX tokens_value ON public.tokens USING btree (value);


--
-- Name: versions_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX versions_project_id ON public.versions USING btree (project_id);


--
-- Name: watchers_user_id_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX watchers_user_id_type ON public.watchers USING btree (user_id, watchable_type);


--
-- Name: wiki_content_versions_wcid; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX wiki_content_versions_wcid ON public.wiki_content_versions USING btree (wiki_content_id);


--
-- Name: wiki_contents_page_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX wiki_contents_page_id ON public.wiki_contents USING btree (page_id);


--
-- Name: wiki_pages_wiki_id_title; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX wiki_pages_wiki_id_title ON public.wiki_pages USING btree (wiki_id, title);


--
-- Name: wiki_redirects_wiki_id_title; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX wiki_redirects_wiki_id_title ON public.wiki_redirects USING btree (wiki_id, title);


--
-- Name: wikis_project_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX wikis_project_id ON public.wikis USING btree (project_id);


--
-- Name: wkfs_role_tracker_old_status; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX wkfs_role_tracker_old_status ON public.workflows USING btree (role_id, tracker_id, old_status_id);


--
-- PostgreSQL database dump complete
--

