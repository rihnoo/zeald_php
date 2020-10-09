<?php

class NBA extends Model
{
    /**
     * Execute a query & return the resulting data as an array of assoc arrays
     * @param string $sql query to execute
     * @return boolean|array array of associative arrays - query results for select
     *     otherwise true or false for insert/update/delete success
     */

    public function runQuery($sql)
    {
        $result = $this->instance->query($sql);

        if (!is_object($result)) {
            return $result;
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}
