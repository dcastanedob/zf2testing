<?php


/**
 * Base class that represents a query for the 'libro' table.
 *
 *
 *
 * @method LibroQuery orderByIdlibro($order = Criteria::ASC) Order by the idlibro column
 * @method LibroQuery orderByLibroNombre($order = Criteria::ASC) Order by the libro_nombre column
 * @method LibroQuery orderByIdautor($order = Criteria::ASC) Order by the idautor column
 * @method LibroQuery orderByIdeditorial($order = Criteria::ASC) Order by the ideditorial column
 *
 * @method LibroQuery groupByIdlibro() Group by the idlibro column
 * @method LibroQuery groupByLibroNombre() Group by the libro_nombre column
 * @method LibroQuery groupByIdautor() Group by the idautor column
 * @method LibroQuery groupByIdeditorial() Group by the ideditorial column
 *
 * @method LibroQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LibroQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LibroQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LibroQuery leftJoinAutor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Autor relation
 * @method LibroQuery rightJoinAutor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Autor relation
 * @method LibroQuery innerJoinAutor($relationAlias = null) Adds a INNER JOIN clause to the query using the Autor relation
 *
 * @method LibroQuery leftJoinEditorial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Editorial relation
 * @method LibroQuery rightJoinEditorial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Editorial relation
 * @method LibroQuery innerJoinEditorial($relationAlias = null) Adds a INNER JOIN clause to the query using the Editorial relation
 *
 * @method Libro findOne(PropelPDO $con = null) Return the first Libro matching the query
 * @method Libro findOneOrCreate(PropelPDO $con = null) Return the first Libro matching the query, or a new Libro object populated from the query conditions when no match is found
 *
 * @method Libro findOneByLibroNombre(string $libro_nombre) Return the first Libro filtered by the libro_nombre column
 * @method Libro findOneByIdautor(int $idautor) Return the first Libro filtered by the idautor column
 * @method Libro findOneByIdeditorial(int $ideditorial) Return the first Libro filtered by the ideditorial column
 *
 * @method array findByIdlibro(int $idlibro) Return Libro objects filtered by the idlibro column
 * @method array findByLibroNombre(string $libro_nombre) Return Libro objects filtered by the libro_nombre column
 * @method array findByIdautor(int $idautor) Return Libro objects filtered by the idautor column
 * @method array findByIdeditorial(int $ideditorial) Return Libro objects filtered by the ideditorial column
 *
 * @package    propel.generator.zf2tutorial.om
 */
abstract class BaseLibroQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLibroQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'zf2tutorial';
        }
        if (null === $modelName) {
            $modelName = 'Libro';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LibroQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LibroQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LibroQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LibroQuery) {
            return $criteria;
        }
        $query = new LibroQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Libro|Libro[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LibroPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LibroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Libro A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdlibro($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Libro A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `idlibro`, `libro_nombre`, `idautor`, `ideditorial` FROM `libro` WHERE `idlibro` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Libro();
            $obj->hydrate($row);
            LibroPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Libro|Libro[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Libro[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LibroPeer::IDLIBRO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LibroPeer::IDLIBRO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idlibro column
     *
     * Example usage:
     * <code>
     * $query->filterByIdlibro(1234); // WHERE idlibro = 1234
     * $query->filterByIdlibro(array(12, 34)); // WHERE idlibro IN (12, 34)
     * $query->filterByIdlibro(array('min' => 12)); // WHERE idlibro >= 12
     * $query->filterByIdlibro(array('max' => 12)); // WHERE idlibro <= 12
     * </code>
     *
     * @param     mixed $idlibro The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function filterByIdlibro($idlibro = null, $comparison = null)
    {
        if (is_array($idlibro)) {
            $useMinMax = false;
            if (isset($idlibro['min'])) {
                $this->addUsingAlias(LibroPeer::IDLIBRO, $idlibro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idlibro['max'])) {
                $this->addUsingAlias(LibroPeer::IDLIBRO, $idlibro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroPeer::IDLIBRO, $idlibro, $comparison);
    }

    /**
     * Filter the query on the libro_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByLibroNombre('fooValue');   // WHERE libro_nombre = 'fooValue'
     * $query->filterByLibroNombre('%fooValue%'); // WHERE libro_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $libroNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function filterByLibroNombre($libroNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libroNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $libroNombre)) {
                $libroNombre = str_replace('*', '%', $libroNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LibroPeer::LIBRO_NOMBRE, $libroNombre, $comparison);
    }

    /**
     * Filter the query on the idautor column
     *
     * Example usage:
     * <code>
     * $query->filterByIdautor(1234); // WHERE idautor = 1234
     * $query->filterByIdautor(array(12, 34)); // WHERE idautor IN (12, 34)
     * $query->filterByIdautor(array('min' => 12)); // WHERE idautor >= 12
     * $query->filterByIdautor(array('max' => 12)); // WHERE idautor <= 12
     * </code>
     *
     * @see       filterByAutor()
     *
     * @param     mixed $idautor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function filterByIdautor($idautor = null, $comparison = null)
    {
        if (is_array($idautor)) {
            $useMinMax = false;
            if (isset($idautor['min'])) {
                $this->addUsingAlias(LibroPeer::IDAUTOR, $idautor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idautor['max'])) {
                $this->addUsingAlias(LibroPeer::IDAUTOR, $idautor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroPeer::IDAUTOR, $idautor, $comparison);
    }

    /**
     * Filter the query on the ideditorial column
     *
     * Example usage:
     * <code>
     * $query->filterByIdeditorial(1234); // WHERE ideditorial = 1234
     * $query->filterByIdeditorial(array(12, 34)); // WHERE ideditorial IN (12, 34)
     * $query->filterByIdeditorial(array('min' => 12)); // WHERE ideditorial >= 12
     * $query->filterByIdeditorial(array('max' => 12)); // WHERE ideditorial <= 12
     * </code>
     *
     * @see       filterByEditorial()
     *
     * @param     mixed $ideditorial The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function filterByIdeditorial($ideditorial = null, $comparison = null)
    {
        if (is_array($ideditorial)) {
            $useMinMax = false;
            if (isset($ideditorial['min'])) {
                $this->addUsingAlias(LibroPeer::IDEDITORIAL, $ideditorial['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ideditorial['max'])) {
                $this->addUsingAlias(LibroPeer::IDEDITORIAL, $ideditorial['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LibroPeer::IDEDITORIAL, $ideditorial, $comparison);
    }

    /**
     * Filter the query by a related Autor object
     *
     * @param   Autor|PropelObjectCollection $autor The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LibroQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAutor($autor, $comparison = null)
    {
        if ($autor instanceof Autor) {
            return $this
                ->addUsingAlias(LibroPeer::IDAUTOR, $autor->getIdautor(), $comparison);
        } elseif ($autor instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LibroPeer::IDAUTOR, $autor->toKeyValue('PrimaryKey', 'Idautor'), $comparison);
        } else {
            throw new PropelException('filterByAutor() only accepts arguments of type Autor or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Autor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function joinAutor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Autor');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Autor');
        }

        return $this;
    }

    /**
     * Use the Autor relation Autor object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AutorQuery A secondary query class using the current class as primary query
     */
    public function useAutorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAutor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Autor', 'AutorQuery');
    }

    /**
     * Filter the query by a related Editorial object
     *
     * @param   Editorial|PropelObjectCollection $editorial The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LibroQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEditorial($editorial, $comparison = null)
    {
        if ($editorial instanceof Editorial) {
            return $this
                ->addUsingAlias(LibroPeer::IDEDITORIAL, $editorial->getIdeditorial(), $comparison);
        } elseif ($editorial instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LibroPeer::IDEDITORIAL, $editorial->toKeyValue('PrimaryKey', 'Ideditorial'), $comparison);
        } else {
            throw new PropelException('filterByEditorial() only accepts arguments of type Editorial or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Editorial relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function joinEditorial($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Editorial');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Editorial');
        }

        return $this;
    }

    /**
     * Use the Editorial relation Editorial object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   EditorialQuery A secondary query class using the current class as primary query
     */
    public function useEditorialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEditorial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Editorial', 'EditorialQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Libro $libro Object to remove from the list of results
     *
     * @return LibroQuery The current query, for fluid interface
     */
    public function prune($libro = null)
    {
        if ($libro) {
            $this->addUsingAlias(LibroPeer::IDLIBRO, $libro->getIdlibro(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
