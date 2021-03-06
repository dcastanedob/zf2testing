<?php



/**
 * This class defines the structure of the 'editorial' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.zf2tutorial.map
 */
class EditorialTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'zf2tutorial.map.EditorialTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('editorial');
        $this->setPhpName('Editorial');
        $this->setClassname('Editorial');
        $this->setPackage('zf2tutorial');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ideditorial', 'Ideditorial', 'INTEGER', true, null, null);
        $this->addColumn('editorial_nombre', 'EditorialNombre', 'VARCHAR', true, 45, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Libro', 'Libro', RelationMap::ONE_TO_MANY, array('ideditorial' => 'ideditorial', ), null, null, 'Libros');
    } // buildRelations()

} // EditorialTableMap
