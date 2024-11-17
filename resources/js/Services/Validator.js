class Validator {
    static checkIfHavePermissions(code, section, branch = null, options = {}) {
        const codePatterns = [
            "editor",
            `editor.${typeof section === "object" ? section.id : section}`,
        ];

        if (branch) {
            codePatterns.push(
                `editor.${typeof section === "object" ? section.id : section}.${
                    typeof branch === "object" ? branch.id : branch
                }`
            );
        }

        if (options.withParent) {
            codePatterns.push(
                `editor.${typeof section === "object" ? section.id : section}.${
                    branch.parent_id
                }`
            );
        }

        return codePatterns.includes(code);
    }

    static checkIfHaveAllPermissions(code) {
        const codePatterns = ["editor"];

        return codePatterns.includes(code);
    }
}

export default Validator;
