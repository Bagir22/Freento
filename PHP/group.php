<?php
    class Group
    {
        function __construct($name, $teams = array())
        {
            $this->name = $name;
            if ($teams)
            {
                $this->teams = array();
                foreach ($teams->teams as $team)
                    $this->addTeam($team);
            }
            else
                $this->teams = $teams;
        }

        function addTeam($team)
        {
            array_push($this->teams, $team);
            return $this;
        }

        function generateCalendar()
        {
            if (count($this->teams) % 2 == 1)
            {
                $pass_team = new Team("pass_team");
                $this->addTeam($pass_team);
            }

            $teams = $this->teams;
            $round = 1;

            for ( $i = 1; $i < count($teams); $i++)
            {
                echo $this->name, ". Round $round\n";
                $teams_reverse = array_reverse($teams);
                for( $j = 0; $j < count($teams)/2; $j++ )
                {
                    if ($teams[$j]->name != "pass_team")
                    {
                        if ($teams_reverse[$j]->name != "pass_team")
                        {
                            $team_name = $teams[$j]->name;
                            $match = $team_name;
                            $team_reverse_country = $teams_reverse[$j]->name;
                            if ($teams[$j]->country)
                            {
                                $team_country = $teams[$j]->country;
                                $match .= " ($team_country)";
                            }
                            $match .= " - $team_reverse_country";
                            if ($teams_reverse[$j]->country)
                            {
                                $team_reverse_country = $teams[$j]->country;
                                $match .= " ($team_reverse_country)";
                            }
                            echo $match, "\n";
                        }
                    }
                    if ( $j + 1 == count($teams)/2)
                        echo "\n";
                }


                $first_team = $teams[0];
                $teams = array_slice($teams, 1);
                for ($a = 0; $a < count($teams)-1; $a++)
                {
                    $tmp = array_shift($teams);
                    array_push($teams, $tmp);
                }
                array_unshift($teams, $first_team);


                $round++;
            }
        }
    }
