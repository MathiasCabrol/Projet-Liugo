#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: presentation
#------------------------------------------------------------

CREATE TABLE presentation(
        id             Int  Auto_increment  NOT NULL ,
        mainPhoto      Blob NOT NULL ,
        description    Text NOT NULL ,
        activitiesPhto Blob NOT NULL ,
        servicesPhoto  Blob NOT NULL
	,CONSTRAINT presentation_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cities
#------------------------------------------------------------

CREATE TABLE cities(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (255) NOT NULL
	,CONSTRAINT cities_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hotels
#------------------------------------------------------------

CREATE TABLE hotels(
        id        Int  Auto_increment  NOT NULL ,
        name      Varchar (200) NOT NULL ,
        email     Varchar (255) NOT NULL ,
        password  Varchar (255) NOT NULL ,
        phone     Varchar (20) NOT NULL ,
        address   Varchar (255) NOT NULL ,
        postcode  Varchar (10) NOT NULL ,
        id_cities Int NOT NULL
	,CONSTRAINT hotels_PK PRIMARY KEY (id)

	,CONSTRAINT hotels_cities_FK FOREIGN KEY (id_cities) REFERENCES cities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: customers
#------------------------------------------------------------

CREATE TABLE customers(
        id        Int  Auto_increment  NOT NULL ,
        lastname  Varchar (150) NOT NULL ,
        firstname Varchar (150) NOT NULL ,
        email     Varchar (255) NOT NULL ,
        phone     Varchar (20) NOT NULL ,
        id_hotels Int NOT NULL
	,CONSTRAINT customers_PK PRIMARY KEY (id)

	,CONSTRAINT customers_hotels_FK FOREIGN KEY (id_hotels) REFERENCES hotels(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: services
#------------------------------------------------------------

CREATE TABLE services(
        id        Int  Auto_increment  NOT NULL ,
        photo     Blob NOT NULL ,
        title     Varchar (150) NOT NULL ,
        id_hotels Int NOT NULL
	,CONSTRAINT services_PK PRIMARY KEY (id)

	,CONSTRAINT services_hotels_FK FOREIGN KEY (id_hotels) REFERENCES hotels(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: subservices
#------------------------------------------------------------

CREATE TABLE subservices(
        id            Int  Auto_increment  NOT NULL ,
        title         Varchar (150) NOT NULL ,
        startingHour  Time NOT NULL ,
        finishingHour Time NOT NULL ,
        price         Float NOT NULL ,
        addButton     Bool NOT NULL ,
        id_services   Int NOT NULL
	,CONSTRAINT subservices_PK PRIMARY KEY (id)

	,CONSTRAINT subservices_services_FK FOREIGN KEY (id_services) REFERENCES services(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: subservicesbutton
#------------------------------------------------------------

CREATE TABLE subservicesbutton(
        id             Int  Auto_increment  NOT NULL ,
        buttonValue    Varchar (150) NOT NULL ,
        file           Blob NOT NULL ,
        id_subservices Int NOT NULL
	,CONSTRAINT subservicesbutton_PK PRIMARY KEY (id)

	,CONSTRAINT subservicesbutton_subservices_FK FOREIGN KEY (id_subservices) REFERENCES subservices(id)
	,CONSTRAINT subservicesbutton_subservices_AK UNIQUE (id_subservices)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: partners
#------------------------------------------------------------

CREATE TABLE partners(
        id        Int  Auto_increment  NOT NULL ,
        name      Varchar (200) NOT NULL ,
        email     Varchar (255) NOT NULL ,
        password  Varchar (255) NOT NULL ,
        phone     Varchar (20) NOT NULL ,
        address   Varchar (255) NOT NULL ,
        postcode  Varchar (10) NOT NULL ,
        id_cities Int NOT NULL
	,CONSTRAINT partners_PK PRIMARY KEY (id)

	,CONSTRAINT partners_cities_FK FOREIGN KEY (id_cities) REFERENCES cities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: bookings
#------------------------------------------------------------

CREATE TABLE bookings(
        id            Int  Auto_increment  NOT NULL ,
        bookingnumber Int NOT NULL ,
        rate          Float NOT NULL ,
        dateHour      Datetime NOT NULL ,
        id_customers  Int NOT NULL ,
        id_partners   Int NOT NULL
	,CONSTRAINT bookings_PK PRIMARY KEY (id)

	,CONSTRAINT bookings_customers_FK FOREIGN KEY (id_customers) REFERENCES customers(id)
	,CONSTRAINT bookings_partners0_FK FOREIGN KEY (id_partners) REFERENCES partners(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categories
#------------------------------------------------------------

CREATE TABLE categories(
        id          Int  Auto_increment  NOT NULL ,
        name        Varchar (255) NOT NULL ,
        description Varchar (255) NOT NULL ,
        photo       Blob NOT NULL ,
        id_partners Int NOT NULL
	,CONSTRAINT categories_PK PRIMARY KEY (id)

	,CONSTRAINT categories_partners_FK FOREIGN KEY (id_partners) REFERENCES partners(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: activities
#------------------------------------------------------------

CREATE TABLE activities(
        id            Int  Auto_increment  NOT NULL ,
        name          Varchar (255) NOT NULL ,
        description   Varchar (255) NOT NULL ,
        photo         Blob NOT NULL ,
        price         Float NOT NULL ,
        id_categories Int NOT NULL
	,CONSTRAINT activities_PK PRIMARY KEY (id)

	,CONSTRAINT activities_categories_FK FOREIGN KEY (id_categories) REFERENCES categories(id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: activitiesDate
#------------------------------------------------------------

CREATE TABLE activitiesDate(
        id          Int  Auto_increment  NOT NULL ,
        dateoppened Datetime NOT NULL ,
        dateclosed  Datetime NOT NULL
	,CONSTRAINT activitiesDate_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hourslots
#------------------------------------------------------------

CREATE TABLE hourslots(
        id   Int  Auto_increment  NOT NULL ,
        time Time NOT NULL
	,CONSTRAINT hourslots_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: define
#------------------------------------------------------------

CREATE TABLE define(
        id            Int NOT NULL ,
        id_activities Int NOT NULL
	,CONSTRAINT define_PK PRIMARY KEY (id,id_activities)

	,CONSTRAINT define_hourslots_FK FOREIGN KEY (id) REFERENCES hourslots(id)
	,CONSTRAINT define_activities0_FK FOREIGN KEY (id_activities) REFERENCES activities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: open
#------------------------------------------------------------

CREATE TABLE open(
        id            Int NOT NULL ,
        id_activities Int NOT NULL
	,CONSTRAINT open_PK PRIMARY KEY (id,id_activities)

	,CONSTRAINT open_activitiesDate_FK FOREIGN KEY (id) REFERENCES activitiesDate(id)
	,CONSTRAINT open_activities0_FK FOREIGN KEY (id_activities) REFERENCES activities(id)
)ENGINE=InnoDB;


