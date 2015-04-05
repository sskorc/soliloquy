<?php

namespace Soliloquy\UserBundle\Manager;

use Soliloquy\UserBundle\Document\Dump;

class DumpManager
{
    /**
     * @var Doctrine\Common\Persistence\ObjectManager
     */
    protected $dm;

    /**
     * @param DDoctrine\Common\Persistence\ObjectManager $dm
     */
    public function __construct($dm)
    {
        $this->dm = $dm;
    }

    /**
     * @return Dump
     */
    public function createDump()
    {
        return new Dump();
    }

    /**
     * @param Dump $dump
     */
    public function persistDump(Dump $dump)
    {
        $movies = $dump->getMovies();

        foreach ($movies as $movieProxy) {
            $movie = $movieProxy->getMovie();

            $this->dm->persist($movie);
            $this->dm->persist($movieProxy);
        }

        $this->dm->persist($dump);
        $this->dm->flush();
    }
}
