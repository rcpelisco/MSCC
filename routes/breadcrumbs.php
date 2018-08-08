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

// Home > Members > [Member] > Edit
Breadcrumbs::for('members.edit', function ($trail, $member) {
    $trail->parent('members.show', $member);
    $trail->push('Edit', route('members.show', $member->id));
});

// Home > Members > [Member] > Loans
Breadcrumbs::for('loans', function ($trail, $member) {
    $trail->parent('members.show', $member);
    $trail->push('Loans');
});

// Home > Members > [Member] > Loans > [Loan]
Breadcrumbs::for('loans.show', function ($trail, $loan) {
    $trail->parent('loans', $loan->member);
    $trail->push($loan->id);
});

// Home > Members > [Member] > Loans > [Loan] > Edit
Breadcrumbs::for('loans.edit', function ($trail, $loan) {
    $trail->parent('loans.show', $loan);
    $trail->push('Edit');
});