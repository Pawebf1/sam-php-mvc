CREATE DATABASE transport;
USE transport;

DROP TABLE IF EXISTS cargo;
DROP TABLE IF EXISTS transport;
CREATE TABLE transport
(
    id             INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    transport_from VARCHAR(30)      NOT NULL,
    transport_to   VARCHAR(30)      NOT NULL,
    airplane_type  VARCHAR(30)      NOT NULL,
    transport_date DATE             NOT NULL,
    documents      VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE cargo
(
    id           INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    transport_id INTEGER UNSIGNED NOT NULL,
    cargo_name   VARCHAR(30)      NOT NULL,
    cargo_weight INTEGER          NOT NULL,
    cargo_type   VARCHAR(30)      NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (transport_id) REFERENCES transport (id)
)

