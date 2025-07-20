import dayjs from "dayjs";
import { transliterate as tr} from "transliteration";
import {trans} from "laravel-vue-i18n";

export function ianseoData(toExport, competition) {
    const SEPARATOR = ";";
    return toExport
        .filter(participant => participant.athlete !== null)
        .map((participant) => {
            //проверим, выбрана ли спортшкола из списка
            let sport_school_code = participant.sport_school !== null
                ? participant.sport_school.code
                : "";
            let sport_school_name = participant.sport_school !== null
                ? participant.sport_school.full_title
                : "";
            //если введено произвольное название спортшколы - берем в качестве кода первые символы названия
            if (participant.sport_school_or_club !== null) {
                sport_school_code = tr(participant.sport_school_or_club).substring(0, 6).trim();
                sport_school_name = participant.sport_school_or_club;
            }

            //todo если решим транслитерировать названия, раскомментировать
            // if (competition.ui_language !== "ru") {
            //     sport_school_name = tr(sport_school_name);
            // }

            const patronymic = (participant.athlete.patronymic !== null
                ? (competition.ui_language !== "ru"
                    ? tr(participant.athlete.patronymic)
                    : participant.athlete.patronymic)
                : "");

            return participant.id + SEPARATOR +
                "1" + SEPARATOR +
                participant.division_code + SEPARATOR +
                participant.class_code + SEPARATOR +
                "" + SEPARATOR +
                "1" + SEPARATOR +
                participant.participate_teams + SEPARATOR +
                "1" + SEPARATOR +
                participant.participate_teams + SEPARATOR +
                participant.participate_mixed_teams + SEPARATOR +
                (competition.ui_language !== "ru" ? tr(participant.athlete.surname) : participant.athlete.surname) + SEPARATOR +
                (competition.ui_language !== "ru" ? tr(participant.athlete.first_name) : participant.athlete.first_name) + SEPARATOR +
                patronymic + SEPARATOR +
                participant.athlete.gender + SEPARATOR +
                participant.region_code + SEPARATOR +
                (participant.region.is_country
                    ? trans("countries." + participant.region_code)
                    : trans("regions." + participant.region_code)) + SEPARATOR +
                dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") + SEPARATOR +
                (competition.use_sport_qualification ? participant.athlete.qualification.code : "") + SEPARATOR +
                sport_school_code + SEPARATOR +
                sport_school_name + SEPARATOR +
                (participant.sport_organisation !== null ? participant.sport_organisation.code : "") + SEPARATOR +
                //todo если решим транслитерировать названия, убрать false
                (participant.sport_organisation !== null
                    ? (false
                        ? tr(participant.sport_organisation.full_title)
                        : participant.sport_organisation.full_title)
                    : "") + SEPARATOR + "\n" +
                "##WHEELCHAIR##" + SEPARATOR + participant.id + SEPARATOR + (participant.athlete.using_chair ? "1" : "0");
        }).reduce((exportData, row) => exportData + row + "\n", "");
}

export async function ianseoExportToFile(participants, competition, divisionAndClassCode = null) {
    var data = new Blob([ianseoData(participants, competition)], {type: 'text/plain'});
    var tempLink = document.createElement("a");

    var fileName = "ianseo_participants_" + competition.id + ".txt";
    if (divisionAndClassCode !== null) {
        fileName = "ianseo_participants_" + competition.id + "_" + divisionAndClassCode + ".txt";
    }
    tempLink.setAttribute('href', URL.createObjectURL(data));
    tempLink.setAttribute('download', fileName);
    tempLink.click();

    URL.revokeObjectURL(tempLink.href);
}
