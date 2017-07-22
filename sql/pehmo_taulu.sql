drop table if exists pehmologi;
drop table if exists pehmo;
create table pehmo (
        id         serial primary key,
        koodi      varchar(12) not null unique,
        nimi       varchar(50) not null,
        kuvaus     varchar(255),
        tila       varchar(255) default 'Aktiivinen',
        
        like pohjat INCLUDING ALL);
comment on table pehmo is 'Seurattavat pehmot';
comment on column pehmo.id is 'Keinotekoinen avain';
comment on column pehmo.koodi is 'Pehmon ylläpitosalasana/käyttäjätunnus';
comment on column pehmo.nimi is 'Pehmon nimi';
comment on column pehmo.kuvaus is 'Pehmon kuvaus';
comment on column pehmo.tila is 'Onko koodi käytössä vai ei, onko pehmo "elossa"?'

        