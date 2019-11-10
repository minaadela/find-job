#Find a Job

*Array Structure*

**Company-name**
This is the company name

**required**
This is an array contains all the required requirements.

**conditional**
This is an array of arrays that contains the conditional requirements for example, this job requires scooter or bike, and apartment or house.
 

``
    'Company-name' => [
        'required' => ['motorcycle'],
        'conditional' => [
            ['scooter', 'bike'],
            ['apartment', 'house'],
        ],
    ],
``