<?php

use \coverallskit\robo\loadTasks as CoverallsKitTasks;
use \peridot\robo\loadTasks as PeridotTasks;
use \Robo\Tasks;

/**
 * Class RoboFile
 */
class RoboFile extends Tasks
{
    use CoverallsKitTasks;
    use PeridotTasks;

    public function specAll()
    {
        $result = $this->taskPeridot()
            ->directoryPath('spec')
            ->reporter('dot')
            ->run();

        return $result;
    }

    public function coverallsUpload()
    {
        $result = $this->taskCoverallsKit()
            ->configureBy('.coveralls.toml')
            ->run();

        return $result;
    }
}
