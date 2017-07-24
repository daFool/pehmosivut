drop table if exists pehmologi;
create table pehmologi (
        id              serial primary key,
        pehmo_id        int not null references pehmo(id) on update cascade on delete set null,
        hetki           timestamp with time zone default now(),
        puumerkki       varchar(255),
        kuvaus          text,
        sijaintit       varchar(255),
        latitude        float,
        longtitude      float,
        edellinen_id    int,
        linkki          text,
        koodi           varchar(40),
        like pohjat INCLUDING ALL );

comment on table pehmologi is 'Pehmojen päiväkirja, missä pehmo on mennyt ja mitä puuhannut';
comment on column pehmologi.id is 'Keinotekoinen avain';
comment on column pehmologi.pehmo_id is 'Pehmon tunniste';
comment on column pehmologi.hetki is 'Tapahtumahetki, päiväkirjan päiväys';
comment on column pehmologi.puumerkki is 'Kuka on kirjannut, nimimerkki';
comment on column pehmologi.kuvaus is 'Mitä pehmo puuhasi/teki';
comment on column pehmologi.sijaintit is 'Sijainnin sanallinen kuvaus';
comment on column pehmologi.latitude is 'Pehmon sijainnin lattitude';
comment on column pehmologi.longtitude is 'Pehmon sijainnin longtitude';
comment on column pehmologi.edellinen_id is 'Tämän pehmon edellinen merkintä';
comment on column pehmologi.linkki is 'Linkki kuvaan tai sosiaaliseen mediaan';
