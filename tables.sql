create table if not exists Freelancer(
    f_id int not null AUTO_INCREMENT,
    name varchar(255) not null,
    ratings int check(ratings >=1 and ratings <=5),
    reward int not null,
    username varchar(45) not null unique,
    password varchar(255) not null,
    primary key(f_id)
);

create table if not exists F_skills(
    f_id int not null,
    skills varchar(20) not null,
    foreign key (f_id) references Freelancer(f_id),
    primary key (f_id, skills)
);

create table if not exists Client(
    c_id int not null AUTO_INCREMENT,
    name varchar(255) not null,
    username varchar(45) not null unique,
    password varchar(255) not null,
    primary key(c_id)
);

create table if not exists Project (
    p_id int not null AUTO_INCREMENT,
    name varchar(255) not null,
    c_id int not null,
    foreign key (c_id) references Client(c_id),
    primary key (p_id)
);

create table if not exists P_free (
    f_id int not null,
    p_id int not null,
    foreign key (f_id) references Freelancer(f_id),
    foreign key (p_id) references Project(p_id),
    primary key (f_id, p_id)
);

create table if not exists P_skills(
    p_id int not null,
    skills varchar(20) not null,
    foreign key (p_id) references Project(p_id),
    primary key (p_id, skills)
);
