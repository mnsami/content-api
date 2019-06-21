<?php
declare(strict_types=1);

namespace Endouble\Xkcd\Infrastructure\Domain\Model\Comic\Doctrine;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Endouble\Xkcd\Domain\Model\Comic\Comic;
use Endouble\Xkcd\Domain\Model\Comic\ComicId;
use Endouble\Xkcd\Domain\Model\Comic\ComicRepository;

class DoctrineComicRepository extends EntityRepository implements ComicRepository
{

    /**
     * @param Comic $comic
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Comic $comic)
    {
        $this->getEntityManager()->persist($comic);
        $this->getEntityManager()->flush();
    }

    /**
     * @param ComicId $comicId
     * @return null|Comic
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     */
    public function ofId(ComicId $comicId): ?Comic
    {
        return $this->getEntityManager()->find($comicId);
    }

    /**
     * @return ComicId
     */
    public function nextIdentity(): ComicId
    {
        return new ComicId();
    }

    /**
     * @return Comic[]
     */
    public function comics(): array
    {
        // TODO: Implement comics() method.
    }
}
