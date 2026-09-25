@local_courseimage 
@javascript
@_file_upload
Feature: Manage a course image
  In order to control the visual identity of a course
  As an editing teacher
  I need to be able to update the course image without editing the course summary

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | One      | teacher1@example.com |
      | student1 | Student   | One      | student1@example.com |
    And the following "courses" exist:
      | fullname    | shortname |
      | Test course | CIMAGE1   |
    And the following "course enrolments" exist:
      | user     | course  | role           |
      | teacher1 | CIMAGE1 | editingteacher |
      | student1 | CIMAGE1 | student        |

  Scenario: An editing teacher can upload a course image
    Given I am on the "Test course" course page logged in as "teacher1"
    When I navigate to "Change course image" in current page administration
    And I set the field "Change course image" to "local/courseimage/tests/fixtures/course-image.png"
    And I press "Save changes"
    Then I should see "Changes saved"
    And I am on the "Test course" course page
    And I navigate to "Change course image" in current page administration
    And the field "Change course image" matches value "course-image.png"

  Scenario: A student cannot see the course image management option
    Given I am on the "Test course" course page logged in as "student1"
    Then I should not see "Change course image"

  Scenario: Cancelling does not save a selected course image
    Given I am on the "Test course" course page logged in as "teacher1"
    And I navigate to "Change course image" in current page administration
    When I set the field "Change course image" to "local/courseimage/tests/fixtures/course-image.png"
    And I press "Cancel"
    Then I should not see "Changes saved"
    And I should see "Test course"
