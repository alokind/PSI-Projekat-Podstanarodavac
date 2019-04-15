
CREATE TABLE [Korisnik]
( 
	[IDK]                integer  NOT NULL ,
	[Ime]                varchar(18)  NULL ,
	[Prezime]            varchar(30)  NULL ,
	[Mail]               varchar(50)  NULL ,
	[Lozinka]            varchar(18)  NULL ,
	[JMBG]               varchar(13)  NULL ,
	[BrojTelefona]       varchar(15)  NULL ,
	[Adresa]             varchar(50)  NULL ,
	[Tip]                varchar(18)  NULL ,
	[Pol]                char(1)  NULL ,
	[IDO]                integer  NULL ,
	CONSTRAINT [XPKKorisnik] PRIMARY KEY  CLUSTERED ([IDK] ASC)
)
go

CREATE TABLE [Kvar]
( 
	[IDKvar]             integer  NOT NULL ,
	[Naslov]             varchar(18)  NULL ,
	[Opis]               varchar(100)  NULL ,
	[IDStanara]          integer  NULL ,
	[IDVlasnika]         integer  NULL ,
	CONSTRAINT [XPKKvar] PRIMARY KEY  CLUSTERED ([IDKvar] ASC)
)
go

CREATE TABLE [ObavestenjeOpomena]
( 
	[IDVlasnik]          integer  NOT NULL ,
	[IDStanara]          integer  NOT NULL ,
	[Naslov]             varchar(18)  NULL ,
	[Tekst]              varchar(100)  NULL ,
	[IDO]                integer  NOT NULL ,
	[Vrsta]              char(18)  NULL ,
	CONSTRAINT [XPKObavestenjeOpomena] PRIMARY KEY  CLUSTERED ([IDVlasnik] ASC,[IDStanara] ASC,[IDO] ASC)
)
go

CREATE TABLE [OglasnaTabla]
( 
	[IDO]                integer  NOT NULL ,
	[Naslov]             varchar(18)  NULL ,
	[Tekst]              varchar(108)  NULL ,
	CONSTRAINT [XPKOglasnaTabla] PRIMARY KEY  CLUSTERED ([IDO] ASC)
)
go

CREATE TABLE [Racun]
( 
	[IDR]                integer  NOT NULL ,
	[IDVlasnika]         integer  NOT NULL ,
	[SvrhaUplate]        varchar(40)  NULL ,
	[PozivNaBroj]        varchar(18)  NULL ,
	[ZiroRacun]          varchar(30)  NULL ,
	[Iznos]              integer  NULL ,
	[IDStanara]          integer  NULL ,
	CONSTRAINT [XPKRacun] PRIMARY KEY  CLUSTERED ([IDR] ASC)
)
go

CREATE TABLE [Zakup]
( 
	[IDZ]                integer  NOT NULL ,
	[AdresaStana]        varchar(50)  NULL ,
	[Kirija]             integer  NULL ,
	[TrajanjeZakupa_Mesec] integer  NULL ,
	[DatumPocetkaZakupa] datetime  NULL ,
	[Kvadratura]         integer  NULL ,
	[IDVlasnika]         integer  NOT NULL ,
	[IDStanara]          integer  NOT NULL ,
	[Prihvacen]          bit  NULL ,
	CONSTRAINT [XPKZakup] PRIMARY KEY  CLUSTERED ([IDZ] ASC,[IDVlasnika] ASC,[IDStanara] ASC)
)
go


ALTER TABLE [Korisnik]
	ADD CONSTRAINT [R_15] FOREIGN KEY ([IDO]) REFERENCES [OglasnaTabla]([IDO])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Kvar]
	ADD CONSTRAINT [R_12] FOREIGN KEY ([IDStanara]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Kvar]
	ADD CONSTRAINT [R_13] FOREIGN KEY ([IDVlasnika]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [ObavestenjeOpomena]
	ADD CONSTRAINT [R_9] FOREIGN KEY ([IDVlasnik]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [ObavestenjeOpomena]
	ADD CONSTRAINT [R_10] FOREIGN KEY ([IDStanara]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Racun]
	ADD CONSTRAINT [R_5] FOREIGN KEY ([IDVlasnika]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Racun]
	ADD CONSTRAINT [R_7] FOREIGN KEY ([IDStanara]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Zakup]
	ADD CONSTRAINT [R_3] FOREIGN KEY ([IDVlasnika]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Zakup]
	ADD CONSTRAINT [R_4] FOREIGN KEY ([IDStanara]) REFERENCES [Korisnik]([IDK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go
