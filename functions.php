<?php

/**
 * Calculation the job requirements and person qualifications to find a job
 *
 * @param $requirements
 * @param $qualifications
 * @return array
 */
function findJob($requirements, $qualifications)
{
    //Calculate the person qualifications with each company with a percentage score
    $companiesScore = [];
    foreach ($requirements as $company => $requirement) {
        //If there are no any requirement, so the person can start working with this job.
        if (empty($requirement)) {
            $companiesScore[$company] = 100;
            continue;
        }

        //Returns an array containing all the values of shared qualifications
        $result = [];
        if (! empty($requirement['required'])) {
            $result[] = array_intersect($requirement['required'], $qualifications);
        }
        if (! empty($requirement['conditional'])) {
            foreach ($requirement['conditional'] as $conditional) {
                if (array_intersect($conditional, $qualifications)) {
                    $result[] = [$conditional[0]];
                }
            }
        }

        //If there are no any matching, so the person can not work with this job.

        if (empty($result)) {
            $companiesScore[$company] = 0;
            continue;
        }

        //Get the count of the job requirement to use it to calculate the percentage.
        $required = ! empty($requirement['required']) ? count($requirement['required']) : 0;
        $conditional = ! empty($requirement['conditional']) ? count($requirement['conditional']) : 0;
        $requirementCount = $required + $conditional;

        //Add the company with its percentage to the array
        $resultCount = count(array_unique(array_merge(...$result)));
        $companiesScore[$company] = ! empty($result) ? (int) round(($resultCount / $requirementCount) * 100) : 0;
    }

    //Sort the array with the same keys(Company name)
    arsort($companiesScore);

    return $companiesScore;
}