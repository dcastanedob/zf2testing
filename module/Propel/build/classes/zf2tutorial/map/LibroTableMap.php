<?php



/**
 * This class defines the structure of the 'libro' table.
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
class LibroTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'zf2tutorial.map.LibroTableMap';

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
        $this->setName('libro');
        $this->setPhpName('Libro');
        $this->setClassname('Libro');
        $this->setPackage('zf2tutorial');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idlibro', 'Idlibro', 'INTEGER', true, null, null);
        $this->addColumn('libro_nombre', 'LibroNombre', 'VARCHAR', true, 45, null);
        $this->addForeignKey('idautor', 'Idautor', 'INTEGER', 'autor', 'idautor', true, null, null);
        $this->addForeignKey('ideditorial', 'Ideditorial', 'INTEGER', 'editorial', 'ideditorial', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Autor', 'Autor', RelationMap::MANY_TO_ONE, array('idautor' => 'idautor', ), null, null);
        $this->addRelation('Editorial', 'Editorial', RelationMap::MANY_TO_ONE, array('ideditorial' => 'ideditorial', ), null, null);
    } // buildRelations()

} // LibroTableMap
