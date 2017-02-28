<?php
class Course
{
    private $id;
    private $name;
    private $course_number;

    function __construct($name, $course_number, $id = null)
    {
        $this->name = $name;
        $this->course_number = $course_number;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getCourseNumber()
    {
        return $this->course_number;
    }

    function setCourseNumber($new_course_number)
    {
        $this->course_number = $new_course_number;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO courses (name, course_number) VALUES ('{$this->getName()}', '{$this->getCourseNumber()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $courses = [];
        $queried_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
        foreach ($queried_courses as $course) {
            $id = $course['id'];
            $name = $course['name'];
            $course_number = $course['course_number'];
            $new_course = new Course($name, $course_number, $id);
            array_push($courses, $new_course);
        }
        return $courses;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses;");
    }
}
?>
