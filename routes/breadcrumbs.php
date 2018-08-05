<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('index'));
});

// Home > Members
Breadcrumbs::for('members', function ($trail) {
    $trail->parent('home');
    $trail->push('Members', route('members.index'));
});

// Home > PAR Report
Breadcrumbs::for('par_report', function ($trail) {
    $trail->parent('home');
    $trail->push('PAR Report', route('par_report.index'));
});

// Home > Members > Create
Breadcrumbs::for('members.create', function ($trail) {
    $trail->parent('members');
    $trail->push('Create', route('members.create'));
});

// Home > Members > [Member]
Breadcrumbs::for('members.show', function ($trail, $member) {
    $trail->parent('members');
    $trail->push($member->first_name . ' ' . $member->last_name, 
        route('members.show', $member->id));
});