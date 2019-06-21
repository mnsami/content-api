<?php
declare(strict_types=1);

namespace Endouble\Spacex\Infrastructure\Domain\Model\Launch\Doctrine;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Endouble\Spacex\Domain\Model\Launch\Launch;
use Endouble\Spacex\Domain\Model\Launch\LaunchId;
use Endouble\Spacex\Domain\Model\Launch\LaunchRepository;

class DoctrineLaunchRepository extends EntityRepository implements LaunchRepository
{
    /**
     * @param Launch $launch
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Launch $launch)
    {
        $this->getEntityManager()->persist($launch);
        $this->getEntityManager()->flush();
    }

    /**
     * @param LaunchId $launchId
     * @return null|Launch
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     */
    public function ofId(LaunchId $launchId): ?Launch
    {
        return $this->getEntityManager()->find($launchId);
    }

    /**
     * @return LaunchId
     */
    public function nextIdentity(): LaunchId
    {
        return new LaunchId();
    }

    /**
     * @return Launch[]
     */
    public function launches(): array
    {
        return $this->findAll();
    }
}
